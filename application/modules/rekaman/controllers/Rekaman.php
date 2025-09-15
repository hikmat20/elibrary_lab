<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

use Mpdf\Mpdf;

class Rekaman extends Admin_Controller
{
	protected $status;
	protected $sts;
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('download');
		$this->load->library(array('upload', 'Image_lib'));
		$this->load->model(array(
			'Aktifitas/aktifitas_model'
		));

		$this->template->set('title', 'List Procedures');
		$this->template->set('icon', 'fa fa-cog');

		date_default_timezone_set("Asia/Bangkok");
		$this->status = [
			'0' => '<span class="badge badge-danger">Invalid</span>',
			'1' => '<span class="badge badge-primary">Publish</span>',
			'DFT' => '<span class="badge badge-secondary">Draft</span>'
		];

		$this->sts = [
			'DFT' => '<span class="label label-secondary label-pill label-inline mr-2">Draft</span>',
			'REV' => '<span class="label label-warning label-pill label-inline mr-2">Waiting Review</span>',
			'COR' => '<span class="label label-danger label-pill label-inline mr-2">Need Correction</span>',
			'APV' => '<span class="label label-info label-pill label-inline mr-2">Waiting Approval</span>',
			'PUB' => '<span class="label label-success label-pill label-inline mr-2">Published</span>',
			'RVI' => '<span class="label label-success label-pill label-inline mr-2">Revision</span>',
			'HLD' => '<span class="label label-light-danger label-pill label-inline mr-2">Hold For Deletion</span>',
		];
	}

	public function index()
	{
				$id = 373;

		if ($id) {
			$grProcess	= $this->db->get_where('group_procedure', ['status' => 'ACT'])->result();
			$getForms	= $this->db->get_where('rekaman', ['status !=' => 'DEL','company_id' => $this->company])->result();
		
			$users 		= $this->db->get_where('view_users', ['status' => 'ACT', 'id_user !=' => '1', 'company_id' => $this->company])->result();
			$jabatan 	= $this->db->get_where('positions', ['company_id' => $this->company])->result();
			$ArrForms = [];
			foreach ($getForms as $frm) {
				$ArrForms[$frm->id] = $frm;
			}
			

			$this->template->set([
				'title' 		=> 'Rekaman',
				'users' 		=> $users,
				'getdForms' 		=> $getForms,
				'jabatan' 		=> $jabatan,
				'ArrForms' 		=> $ArrForms,
				'sts' 			=> $this->sts,
			]);
				
			$this->template->set('grProcess', $grProcess);
			$this->template->render('index');
		} else {
			$data = [
				'heading' => 'Error!',
				'message' => 'Data not found..'
			];
			$this->template->render('../views/errors/html/error_404_custome', $data);
		}
		$this->template->render('index');
	}

	public function add()
	{
		$grProcess	= $this->db->get_where('group_procedure', ['status' => 'ACT'])->result();
		$users 		= $this->db->get_where('view_users', ['status' => 'ACT', 'id_user !=' => '1', 'company_id' => $this->company])->result();
		$jabatan 	= $this->db->get_where('positions', ['company_id' => $this->company])->result();

		$this->template->set([
			'grProcess' 	=> $grProcess,
			'users' 		=> $users,
			'jabatan' 		=> $jabatan,
		]);

		$this->template->set('title', 'Add Procedures');
		$this->template->render('add');
	}

	public function edit($id = '')
	{
		$Data 			= $this->db->get_where('procedures', ['company_id' => $this->company, 'id' => $id])->row();

		if ($Data) {
			$Data_detail 	= $this->db->get_where('procedure_details', ['procedure_id' => $id, 'status' => '1'])->result();
			$grProcess	= $this->db->get_where('group_procedure', ['status' => 'ACT'])->result();
			$getForms	= $this->db->get_where('rekaman', ['status !=' => 'DEL'])->result();
			$getGuides	= $this->db->get_where('dir_guides', ['procedure_id' => $id, 'status !=' => 'DEL'])->result();
			$getRecords	= $this->db->get_where('dir_records', ['procedure_id' => $id, 'status !=' => 'DEL', 'flag_type' => 'FOLDER', 'parent_id' => null])->result();
			$users 		= $this->db->get_where('view_users', ['status' => 'ACT', 'id_user !=' => '1', 'company_id' => $this->company])->result();
			$jabatan 	= $this->db->get_where('positions', ['company_id' => $this->company])->result();

			$ArrForms = [];
			foreach ($getForms as $frm) {
				$ArrForms[$frm->id] = $frm;
			}
			$ArrGuides = [];
			foreach ($getGuides as $gui) {
				$ArrGuides[$gui->id] = $gui;
			}

			$this->template->set([
				'title' 		=> 'Edit Procedures',
				'data' 			=> $Data,
				'users' 		=> $users,
				'detail' 		=> $Data_detail,
				'getForms' 		=> $getForms,
				'getGuides' 	=> $getGuides,
				'getRecords' 	=> $getRecords,
				'jabatan' 		=> $jabatan,
				'ArrForms' 		=> $ArrForms,
				'ArrGuides' 	=> $ArrGuides,
				'sts' 			=> $this->sts,
			]);

			$this->template->set('grProcess', $grProcess);
			$this->template->render('edit');
		} else {
			$data = [
				'heading' => 'Error!',
				'message' => 'Data not found..'
			];
			$this->template->render('../views/errors/html/error_404_custome', $data);
		}
	}

	public function view($id = '', $status = '')
	{
		$Data 				= $this->db->get_where('procedures', ['id' => $id, 'company_id' => $this->company])->row();
		$users 				= $this->db->get_where('view_users')->result();
		$getForms			= $this->db->get_where('rekaman', ['procedure_id' => $id])->result();
		$getGuides			= $this->db->get_where('dir_guides', ['procedure_id' => $id])->result();
		$jabatan 			= $this->db->get('positions')->result();
		$ArrUsr 			= $ArrJab = $ArrForms = $ArrGuides = [];

		foreach ($getForms as $frm) {
			$ArrForms[$frm->id] = $frm;
		}
		foreach ($getGuides as $gui) {
			$ArrGuides[$gui->id] = $gui;
		}

		foreach ($users as $usr) {
			$ArrUsr[$usr->id_user] = $usr;
		}

		foreach ($jabatan as $jab) {
			$ArrJab[$jab->id] = $jab;
		}

		if ($Data) {
			$Data_detail 		= $this->db->get_where('procedure_details', ['procedure_id' => $id, 'status' => '1'])->result();
			$this->template->set([
				'title' 		=> 'Procedures',
				'data' 			=> $Data,
				'detail' 		=> $Data_detail,
				'users' 		=> $users,
				'jabatan' 		=> $jabatan,
				'ArrUsr' 		=> $ArrUsr,
				'ArrJab' 		=> $ArrJab,
				'ArrForms' 		=> $ArrForms,
				'ArrGuides' 	=> $ArrGuides,
			]);
			$this->template->render('view');
		} else {
			$data = [
				'heading' 	=> 'Error!',
				'message' 	=> 'Data not found..'
			];
			$this->template->render('../views/errors/html/error_404_custome', $data);
		}
	}

	public function save()
	{
		$Data 			= $this->input->post();
		$Data_flow 		= $this->input->post('flow');

		unset($Data['DataTables_Table_0_length']);
		unset($Data['DataTables_Table_1_length']);
		unset($Data['DataTables_Table_2_length']);
		if ($Data) {
			if (isset($_FILES)) {
				$images = $this->upload_images();

				if ((isset($images['error']) && $images['error']) == '1') {
					$this->db->trans_rollback();
					$Return = [
						'status' => 0,
						'msg'	 => $images['error_msg'] . ' File gambar gagal diupload, silahkan coba lagi.'
					];
					echo json_encode($Return);
					return false;
				}

				($images['image1']) ? $Data['image_flow_1'] = $images['image1'] : null;
				($images['image2']) ? $Data['image_flow_2'] = $images['image2'] : null;
				($images['image3']) ? $Data['image_flow_3'] = $images['image3'] : null;
				($images['flow_file']) ? $Data['flow_file'] = $images['flow_file'] : null;
			}

			$Data['company_id'] 	= $this->company;
			$dist 					= isset($Data['distribute_id']) ? implode(",", $Data['distribute_id']) : null;
			$Data['distribute_id']	= $dist;

			unset($Data['flow']);
			$this->db->trans_begin();
			if (isset($Data['id'])) {
				$Data['modified_by'] = $this->auth->user_id();
				$Data['modified_at'] = date('Y-m-d H:i:s');
				$pro_id = $Data['id'];
				$this->db->update('procedures', $Data, ['id' => $Data['id']]);
			} else {
				$Data['created_by'] = $this->auth->user_id();
				$Data['created_at'] = date('Y-m-d H:i:s');
				$this->db->insert('procedures', $Data);
				$pro_id = $this->db->order_by('id', 'DESC')->get_where('procedures')->row()->id;
				$thisData = $this->db->get_where('procedures', ['company_id' => $this->company, 'name' => $Data['name']])->row();
				$dataLog = [
					'directory_id' 	=> $thisData->id,
					'new_status' 	=> $thisData->status,
					'doc_type' 		=> 'Procedure',
					'note' 			=> 'New input data procedure',
				];
				$this->_update_history($dataLog);
			}
		}

		if ($Data_flow) {
			$Data_flow['procedure_id'] = $pro_id;
			if (isset($Data_flow['id']) && $Data_flow['id']) {
				$Data_flow['relate_doc'] 		= isset($Data_flow['relate_doc']) ? json_encode($Data_flow['relate_doc']) : '-';
				$Data_flow['relate_ik_doc'] 	= isset($Data_flow['relate_ik_doc']) ? json_encode($Data_flow['relate_ik_doc']) : '-';
				$Data_flow['modified_by'] 		= $this->auth->user_id();
				$Data_flow['modified_at'] 		= date('Y-m-d H:i:s');
				$this->db->update('procedure_details', $Data_flow, ['id' => $Data_flow['id']]);
			} else {
				$Data_flow['relate_doc'] 		= isset($Data_flow['relate_doc']) ? json_encode($Data_flow['relate_doc']) : '-';
				$Data_flow['relate_ik_doc'] 	= isset($Data_flow['relate_ik_doc']) ? json_encode($Data_flow['relate_ik_doc']) : '-';
				$Data_flow['created_by'] 		= $this->auth->user_id();
				$Data_flow['created_at'] 		= date('Y-m-d H:i:s');
				$this->db->insert('procedure_details', $Data_flow);
			}
		}

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$Return		= array(
				'status'		=> 0,
				'msg'			=> 'Data Procedure failed to save. Please try again.',
			);
		} else {
			$this->db->trans_commit();
			$Return		= array(
				'status'		=> 1,
				'msg'			=> 'Data Procedure successfully saved..',
				'id'			=> $pro_id,
			);
		}
		echo json_encode($Return);
	}

	

	public function load_file_flow($id)
	{
		$data = [];
		if ($id) {
			$data = $this->db->get_where('procedures', ['id' => $id])->row();

			$return = [
				'status' => 1,
				'data' => $data
			];
		} else {
			$return = [
				'status' => 0,
				'data' => $data
			];
		}

		echo json_encode($return);
	}


	

	private function _update_history($data)
	{
		$data['updated_by']    = $this->auth->user_id();
		$data['updated_at']    = date('Y-m-d H:i:s');
		$this->db->insert('directory_log', $data);
	}

	function delete_procedure($id)
	{
		$this->db->trans_begin();
		if (($id)) {
			$data['deleted_by'] = $this->auth->user_id();
			$data['deleted_at'] = date('Y-m-d H:i:s');
			$data['status'] = 'DEL';
			$this->db->update('procedures', $data, ['company_id' => $this->company, 'id' => $id]);
		}

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$Return		= array(
				'status'		=> 0,
				'msg'			=> 'Data Procedure failed to delete. Please try again.',
			);
		} else {
			$this->db->trans_commit();
			$Return		= array(
				'status'		=> 1,
				'msg'			=> 'Data Procedure successfully delete..',
			);
		}
		echo json_encode($Return);
	}

	function review($id)
	{
		$this->db->trans_begin();
		if (($id)) {
			$thisData = $this->db->get_where('procedures', ['id' => $id])->row();
			if($thisData->reviewer_id == '' || $thisData->reviewer_id == null ||$thisData->approval_id == '' || $thisData->approval_id == null){
				$Return		= array(
					'status'		=> 0,
					'msg'			=> 'Please select Reviewer User And Approval User first to go to the next process.',
				);
				echo json_encode($Return);
				return false;
			}

			$data['modified_by'] = $this->auth->user_id();
			$data['modified_at'] = date('Y-m-d H:i:s');
			$data['status'] = 'REV';

			if($thisData->status == 'RVI'){
				$data['revision'] = $thisData->revision +1;
				$data['revision_date'] = date('Y-m-d H:i:s');
			}

			$this->db->update('procedures', $data, ['company_id' => $this->company, 'id' => $id]);
			$dataLog = [
				'directory_id' 	=> $id,
				'old_status'	=> $thisData->status,
				'new_status' 	=> $data['status'],
				'note' 			=> 'Update data procedure',
				'doc_type' 		=> 'Procedure',
			];

			$this->_update_history($dataLog);
		}

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$Return		= array(
				'status'		=> 0,
				'msg'			=> 'Can\'t process this data. Please try again.',
			);
		} else {
			$this->db->trans_commit();
			$Return		= array(
				'status'		=> 1,
				'msg'			=> 'Data Procedure successfully processed for review..',
			);
		}
		echo json_encode($Return);
	}

	function cancel_review($id)
	{
		$this->db->trans_begin();
		if (($id)) {
			$thisData = $this->db->get_where('procedures', ['id' => $id])->row();
			$data['modified_by'] = $this->auth->user_id();
			$data['modified_at'] = date('Y-m-d H:i:s');
			$data['status'] = 'DFT';
			$this->db->update('procedures', $data, ['company_id' => $this->company, 'id' => $id]);
			$dataLog = [
				'directory_id' 			=> $id,
				'old_status' 	=> $thisData->status,
				'new_status' 	=> $data['status'],
				'doc_type' 		=> 'Procedure',
				'note'			=> 'Cancel review data procdedure'
			];

			$this->_update_history($dataLog);
		}

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$Return		= array(
				'status'		=> 0,
				'msg'			=> 'Can\'t cancle this data. Please try again.',
			);
		} else {
			$this->db->trans_commit();
			$Return		= array(
				'status'		=> 1,
				'msg'			=> 'Data Procedure successfully canceled for review..',
			);
		}
		echo json_encode($Return);
	}

	function delete_flow($id)
	{
		$this->db->trans_begin();
		if (($id)) {
			$data['deleted_by'] = $this->auth->user_id();
			$data['deleted_at'] = date('Y-m-d H:i:s');
			$data['status'] = '0';
			$this->db->update('procedure_details', $data, ['id' => $id]);
		}

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$Return		= array(
				'status'		=> 0,
				'msg'			=> 'Data Procedure failed to save. Please try again.',
			);
		} else {
			$this->db->trans_commit();
			$Return		= array(
				'status'		=> 1,
				'msg'			=> 'Data Procedure successfully saved..',
			);
		}
		echo json_encode($Return);
	}

	function delete_img($id, $dataImg)
	{
		$this->db->trans_begin();
		if (($id)) {
			$data['modified_by'] = $this->auth->user_id();
			$data['modified_at'] = date('Y-m-d H:i:s');
			$data["$dataImg"] = null;
			$this->db->update('procedures', $data, ['id' => $id]);
		}

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$Return		= array(
				'status'		=> 0,
				'msg'			=> 'Failed to delete image.. Please try again.',
			);
		} else {
			$this->db->trans_commit();
			$Return		= array(
				'status'		=> 1,
				'msg'			=> 'Successfully deleted image..',
			);
		}

		echo json_encode($Return);
	}

	public function upload_images()
	{
		$this->load->library('upload');
		$dataInfo = array();
		$files = $_FILES;

		if (!is_dir('./directory/FLOW_IMG/' . $this->company . '/')) {
			mkdir('./directory/FLOW_IMG/' . $this->company . '/', 0755, TRUE);
			chmod('./directory/FLOW_IMG/' . $this->company . '/', 0755);  // octal; correct value of mode
			chown('./directory/FLOW_IMG/' . $this->company . '/', 'www-data');
		}

		$cpt = count($_FILES['img_flow']['name']);

		for ($i = 0; $i < $cpt; $i++) {
			$_FILES['img_flow']['name'] 	= $files['img_flow']['name'][$i];
			$_FILES['img_flow']['type'] 	= $files['img_flow']['type'][$i];
			$_FILES['img_flow']['tmp_name'] = $files['img_flow']['tmp_name'][$i];
			$_FILES['img_flow']['error'] 	= $files['img_flow']['error'][$i];
			$_FILES['img_flow']['size'] 	= $files['img_flow']['size'][$i];

			if ($files['img_flow']['name'][$i]) {
				$this->upload->initialize($this->set_upload_options());
				$this->upload->do_upload('img_flow');
				$dataInfo[] = $this->upload->data();
				if ($this->upload->display_errors()) {
					return [
						'error' => 1,
						'error_msg' => $this->upload->display_errors(),
					];
					return false;
				}
			} else {
				$dataInfo[$i]['file_name'] = $files['img_flow']['name'][$i];
			}
		}

		if ($_FILES['flow_file']['name']) {
			$this->upload->initialize($this->set_upload_file_options());
			$this->upload->do_upload('flow_file');
			$fileInfo = $this->upload->data();
			if ($this->upload->display_errors()) {
				return [
					'error' => 1,
					'error_msg' => $this->upload->display_errors(),
				];
				return false;
			}
		} else {
			$fileInfo['file_name'] = $_FILES['flow_file']['name'];
		}

		return array(
			'image1' 		=> $dataInfo[0]['file_name'],
			'image2' 		=> $dataInfo[1]['file_name'],
			'image3' 		=> $dataInfo[2]['file_name'],
			'flow_file' 	=> $fileInfo['file_name'],
		);
	}

	private function set_upload_options()
	{
		//upload an image options
		$config = array();
		$config['upload_path'] 	 = './directory/FLOW_IMG/' . $this->company . '/';
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		$config['max_size']      = 5120; // 5mb;
		$config['overwrite']     = TRUE;
		$config['encrypt_name']  = TRUE;

		return $config;
	}

	private function set_upload_file_options()
	{
		if (!is_dir('./directory/FLOW_FILE/' . $this->company . '/')) {
			mkdir('./directory/FLOW_FILE/' . $this->company . '/', 0755, TRUE);
			chmod('./directory/FLOW_FILE/' . $this->company . '/', 0755);  // octal; correct value of mode
			chown('./directory/FLOW_FILE/' . $this->company . '/', 'www-data');
		}

		//upload an image options
		$config = array();
		$config['upload_path'] 	 = './directory/FLOW_FILE/' . $this->company . '/';
		$config['allowed_types'] = 'pdf';
		$config['max_size']      = 5120; // 5mb;
		$config['overwrite']     = TRUE;
		$config['encrypt_name']  = TRUE;

		return $config;
	}

	public function view_form($id = null)
	{
		if ($id) {
			$file 		= $this->db->get_where('rekaman', ['id' => $id])->row();
			// $dir_name 	= $this->db->get_where('dir_form', ['id' => $file->parent_id])->row()->name;
			$history	= $this->db->order_by('updated_at', 'ASC')->get_where('view_directory_log', ['directory_id' => $id])->result();
			// $this->template->set('dir_name', $dir_name);
			$this->template->set('sts', $this->sts);
			$this->template->set('file', $file);
			$this->template->set('type', 'form');
			$this->template->set('history', $history);
			$this->template->render('show');
		} else {
			echo "~ Not data available ~";
		}
	}

	public function upload_form($id = null)
	{
		$users 		= $this->db->get_where('view_users', ['status' => 'ACT', 'id_user !=' => '1', 'company_id' => $this->company])->result();
		$jabatan 	= $this->db->get('positions')->result();

		$this->template->set([
			'jabatan' 		=> $jabatan,
			'procedure_id' 	=> $id,
			'users' 		=> $users,
			'type' 			=> "form",
		]);
		$this->template->render('upload_file_form');
	}

	public function edit_form($id = null)
	{
		$users 		= $this->db->get_where('view_users', ['status' => 'ACT', 'id_user !=' => '1', 'company_id' => $this->company])->result();
		$jabatan 	= $this->db->get('positions')->result();
		$data = $this->db->get_where('rekaman', ['id' => $id])->row();


		$this->template->set([
			'data' 			=> $data,
			'jabatan' 		=> $jabatan,
			// 'procedure_id' 	=> $data->procedure_id,
			'users' 		=> $users,
			'type' 			=> "form",
		]);
		$this->template->render('upload_file_form');
	}

	public function delete_form($id = null)
	{
		if ($id) {
			$this->db->trans_begin();
			$data = [
				'status' => 'DEL',
				'deleted_by' => $this->auth->user_id(),
				'deleted_at' => date('Y-m-d H:i:s'),
			];
			$this->db->update('rekaman', $data, ['id' => $id]);
			$file_name = $this->db->get_where('rekaman', ['id' => $id])->row()->file_name;
			$this->_delete_file('FORMS', $file_name);
			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				$Return = [
					'status' => '0',
					'msg' => 'Data failed to delete, pelase try again.'
				];
			} else {
				$this->db->trans_commit();
				$Return = [
					'status' => '1',
					'msg' => 'Data successfull deleted.'
				];
			}
		} else {
			$Return = [
				'status' => '0',
				'msg' => 'Data not valid'
			];
		}

		echo json_encode($Return);
	}

	public function saveForm()
	{
		$data = $this->input->post('forms');
		if ($data) {
			$id 					= (!$data['id']) ? uniqid(date('m')) : $data['id'];
			$data['id']	    		= $id;
			$data['name']	    	= $data['description'];
			$data['company_id']		= $this->company;
			$check 					= $this->db->get_where('rekaman', ['id' => $id])->num_rows();
			$note 					= isset($data['note']) ? $data['note'] : null;
			$data['status']			= isset($data['status']) ? $data['status'] : 'OPN';
			unset($data['note']);
			unset($data['type']);

			if (isset($_FILES['forms_image'])) {
				if (!is_dir("./directory/FORMS/$this->company/")) {
					mkdir("./directory/FORMS/$this->company/", 0755, TRUE);
					chmod("./directory/FORMS/$this->company/", 0755);  // octal; correct value of mode
					chown("./directory/FORMS/$this->company/", 'www-data');
				}
				$config['upload_path'] 		= "./directory/FORMS/$this->company"; //path folder
				$config['allowed_types'] 	= 'pdf|xlsx|docx'; //type yang dapat diakses bisa anda sesuaikan
				$config['encrypt_name'] 	= true; //Enkripsi nama yang terupload
				// $config['file_name'] 		= $new_name;

				$this->upload->initialize($config);
				if ($this->upload->do_upload('forms_image')) :
					$file 					= $this->upload->data();
					$data['size']  			= $file['file_size'];
					$data['ext']     		= $file['file_ext'];
					$data['file_name']  	= $file['file_name'];
					// $data['flag_type']		= 'FILE';
					// $dist 					= isset($data['distribute_id']) ? implode(",", $data['distribute_id']) : null;
					// $data['distribute_id']	= $dist;
					$old_file 				= isset($data['old_file']) ? $data['old_file'] : null;
					unset($data['old_file']);

					if ($old_file != null) {
						if (file_exists("./directory/FORMS/$this->company/" . $old_file)) {
							unlink("./directory/FORMS/$this->company/" . $old_file);
						}
					};

				else :
					$error_msg = $this->upload->display_errors();
					$this->db->trans_rollback();
					$Return = [
						'status' => 0,
						'msg'	 => $error_msg . ' File Form gagal diupload, silahkan coba lagi.'
					];
					echo json_encode($Return);
					return false;
				endif;
			}

			if (intval($check) == '0') {
				$data['created_by']		= $this->auth->user_id();
				$data['created_at']		= date('Y-m-d H:i:s');
				$data['note']			= 'First Upload File';
				$this->db->insert('rekaman', $data);
			} else {
				$data['modified_by']	= $this->auth->user_id();
				$data['modified_at']	= date('Y-m-d H:i:s');
				$data['jmlh_revisi']	= $data['jmlh_revisi'] + 1;
				$this->db->update('rekaman', $data, ['id' => $id]);
			}

			$dataLog = [
				'directory_id' 	=> $id,
				'new_status' 	=> $data['status'],
				'doc_type' 		=> 'Form',
				'note'			=> 'Upload file'
			];

			$this->_update_history($dataLog);
		}

		if ($this->db->trans_status() === 'FALSE') {
			$this->db->trans_rollback();
			$Return = [
				'status' => 0,
				'msg'	 => 'File Form gagal diupload, silahkan coba lagi.'
			];
		} else {
			$this->db->trans_commit();
			$Return = [
				'status' => 1,
				'msg'	 => 'File Form berhasil di upload. Terima kasih'
			];
		}

		echo json_encode($Return);
	}

	public function loadDataForm()
	{
		$getForms	= $this->db->get_where('rekaman', ['status !=' => 'DEL','company_id' => $this->company])->result();
		$this->template->set('getForms', $getForms);
		$this->template->render('data-forms');
	}

	private function _delete_file($dir = null, $file_name = null)
	{
		if ($dir && $file_name) {
			if (file_exists("./directory/$dir/$this->company/" . $file_name)) {
				unlink("./directory/$dir/$this->company/" . $file_name);
			}
		}
	}

	

}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Monitoring extends Admin_Controller
{
	/*
 * @author Yunaz
 * @copyright Copyright (c) 2016, Yunaz
 * 
 * This is controller for Penerimaan
 */
	public function __construct()
	{
		parent::__construct();

		$this->load->model('monitoring/monitoring_model', 'Monitor_model');
		$this->template->set_theme('dashboard');
		$this->template->page_icon('fa fa-dashboard');

		$this->sts = [
			'' => '<span class="label label-light-secondary label-pill label-inline mr-2 text-dark-50">!Null!</span>',
			'OPN' => '<span class="label label-light-primary label-pill label-inline mr-2">New</span>',
			'REV' => '<span class="label label-light-warning label-pill label-inline mr-2">Waiting Review</span>',
			'COR' => '<span class="label label-light-danger label-pill label-inline mr-2">Need Correction</span>',
			'APV' => '<span class="label label-light-info label-pill label-inline mr-2">Waiting Approval</span>',
			'PUB' => '<span class="label label-light-success label-pill label-inline mr-2">Published</span>',
			'RVI' => '<span class="label label-light-danger label-pill label-inline mr-2">Revision</span>',
		];
	}

	public function index()
	{

		/* REVIEW */
		// $dtProcedureRev = $this->db->get_where('procedures', ['company_id' => $this->company, 'status' => 'REV'])->num_rows();
		$dtGuidesRev 	= 0; // $this->db->get_where('dir_guides', ['company_id' => $this->company, 'status' => 'REV'])->num_rows();

		/* APPROVAL */
		// $dtProcedureApv = $this->db->get_where('procedures', ['company_id' => $this->company, 'status' => 'APV'])->num_rows();
		$dtGuidesApv 	= 0; // $this->db->get_where('dir_guides', ['company_id' => $this->company, 'status' => 'APV'])->num_rows();

		/* CORRECTION */
		// $dtProcedureCor = $this->db->get_where('procedures', ['company_id' => $this->company, 'status' => 'COR'])->num_rows();
		$dtGuidesCor 	= 0; // $this->db->get_where('dir_guides', ['company_id' => $this->company, 'status' => 'COR'])->num_rows();

		/* REVISION */
		// $dtProcedureRvi = $this->db->get_where('procedures', ['company_id' => $this->company, 'status' => 'RVI'])->num_rows();
		$dtGuidesRvi 	= 0; // $this->db->get_where('dir_guides', ['company_id' => $this->company, 'status' => 'RVI'])->num_rows();

		/* PUBLISH */
		// $dtProcedurePub = $this->db->get_where('procedures', ['company_id' => $this->company, 'status' => 'PUB'])->num_rows();
		$dtGuidesPub 	=  0; //$this->db->get_where('dir_guides', ['company_id' => $this->company, 'status' => 'PUB'])->num_rows();


		$dtProc = $this->db->get_where('procedures', ['company_id' => $this->company, 'status !=' => 'DEL'])->result();

		$rev 	= $cor = $pub = $apv = $rvi = 0;
		foreach ($dtProc as $value) {
			if ($value->status == 'REV') {
				$rev = $rev + 1;
			}
			if ($value->status == 'COR') {
				$cor = $cor + 1;
			}
			if ($value->status == 'PUB') {
				$pub = $pub + 1;
			}
			if ($value->status == 'APV') {
				$apv = $apv + 1;
			}
			if ($value->status == 'RVI') {
				$rvi = $rvi + 1;
			}
		}

		$Data = $this->db->order_by('created_at', 'ASC')->get_where('directory', ['parent_id' => '0', 'active' => 'Y', 'status !=' => 'DEL'])->result();
		$RecentFiles = $this->db->order_by('created_at', 'DESC')->get_where('directory', ['parent_id !=' => '0', 'active' => 'Y', 'flag_type' => 'FILE', 'status !=' => 'DEL', 'created_at like' => date('Y-m-d') . "%"])->result();

		$this->template->set(
			[
				'title' 			=> 'Dashboard',
				'Data' 				=> $Data,
				'RecentFiles' 		=> $RecentFiles,
				'dtProcedureRev' 	=> $rev,
				'dtProcedureApv'    => $apv,
				'dtProcedureCor'    => $cor,
				'dtProcedureRvi' 	=> $rvi,
				'dtProcedurePub'	=> $pub,
				'dtGuidesApv' 		=> $dtGuidesApv,
				'dtGuidesRev' 		=> $dtGuidesRev,
				'dtGuidesCor' 		=> $dtGuidesCor,
				'dtGuidesPub' 		=> $dtGuidesPub,
				'dtGuidesRvi' 		=> $dtGuidesRvi,
			]
		);

		$this->template->render('index');
	}

	public function view($id = null, $type = null)
	{
		$file 		= $this->db->get_where('procedures', ['id' => $id])->row();
		$history	= $this->db->order_by('updated_at', 'ASC')->get_where('directory_log', ['directory_id' => $id])->result();
		$this->template->set('sts', $this->sts);
		$this->template->set('file', $file);
		$this->template->set('type', $type);
		$this->template->set('history', $history);
		$this->template->render('view');
	}


	/* REVIEW PROCESS */

	public function review()
	{
		/* REVIEW */
		$procedures 	= $this->db->get_where('view_procedures', ['company_id' => $this->company, 'status' => 'REV'])->result();
		$users = $this->db->get_where('users')->result();

		$ArrUsers = [];
		foreach ($users as $user) {
			$ArrUsers[$user->id_user] = $user;
		}

		$this->template->set([
			'title'			=> 'REVIEW PROCEDURES',
			'procedures' 	=> $procedures,
			'sts'			=> $this->sts,
			'ArrUsers'		=> $ArrUsers,
		]);

		$this->template->render('list');
	}

	public function load_form_review($id, $type = null)
	{
		$file 		= $this->db->get_where('procedures', ['id' => $id])->row();
		$history	= $this->db->order_by('updated_at', 'ASC')->get_where('directory_log', ['directory_id' => $id])->result();
		$this->template->set('sts', $this->sts);
		$this->template->set('file', $file);
		$this->template->set('type', $type);
		$this->template->set('history', $history);
		$this->template->render('review/review-form');
	}

	public function save_review()
	{
		$data = $this->input->post();


		if ($data) {
			$this->db->trans_begin();
			$this->Monitor_model->review($data);
			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				$Return = [
					'status' => 0,
					'msg'	 => 'Failed process review document. Please try again later.!'
				];
			} else {
				$this->db->trans_commit();
				$Return = [
					'status' => 1,
					'msg'	 => 'Success process review document...'
				];
			}
		} else {
			$Return = [
				'status' => 0,
				'msg'	 => 'Data not valid.'
			];
		}

		echo json_encode($Return);
	}

	/* END REVIEW PROCESS */


	/* CORRECTION RPOCESS */
	public function correction()
	{
		/* CORRECTION */
		$procedures 	= $this->db->get_where('view_procedures', ['company_id' => $this->company, 'status' => 'COR'])->result();
		$users = $this->db->get_where('users')->result();

		$ArrUsers = [];
		foreach ($users as $user) {
			$ArrUsers[$user->id_user] = $user;
		}

		$this->template->set([
			'title'			=> 'CORRECTION PROCEDURES',
			'procedures' 	=> $procedures,
			'sts'			=> $this->sts,
			'ArrUsers'		=> $ArrUsers,
		]);
		$this->template->render('list');
	}

	public function load_form_correction($id = null, $type = null)
	{
		$file 		= $this->db->get_where('procedures', ['id' => $id])->row();
		$history	= $this->db->order_by('updated_at', 'ASC')->get_where('directory_log', ['directory_id' => $id])->result();
		$this->template->set('sts', $this->sts);
		$this->template->set('file', $file);
		$this->template->set('type', $type);
		$this->template->set('history', $history);
		$this->template->render('correction/correction-form');
	}

	public function save_correction()
	{
		$data = $this->input->post();

		if ($data) {
			$this->db->trans_begin();
			$this->db->update(
				'directory',
				[
					'status' => $data['status'],
					'modified_by' => $this->auth->user_id(),
					'modified_at' => date('Y-m-d H:i:s'),
				],
				['id' => $data['id']]
			);
			$this->_update_history($data);

			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				$Return = [
					'status' => 0,
					'msg'	 => 'Failed upload document file. Please try again later.!'
				];
			} else {
				$this->db->trans_commit();
				$Return = [
					'status' => 1,
					'msg'	 => 'Success upload document file...'
				];
			}
		} else {
			$Return = [
				'status' => 0,
				'msg'	 => 'Data not valid.'
			];
		}

		echo json_encode($Return);
	}

	/* END CORRECTION PROCESS */


	/* APPROVAL RPOCESS */
	public function approval()
	{
		/* APPROVAL */
		$procedures 	= $this->db->get_where('view_procedures', ['company_id' => $this->company, 'status' => 'APV'])->result();
		$users = $this->db->get_where('users')->result();

		$ArrUsers = [];
		foreach ($users as $user) {
			$ArrUsers[$user->id_user] = $user;
		}

		$this->template->set([
			'title'			=> 'APPROVAL PROCEDURES',
			'procedures' 	=> $procedures,
			'sts'			=> $this->sts,
			'ArrUsers'		=> $ArrUsers,
		]);
		$this->template->render('list');
	}

	public function load_form_approval($id, $type = null)
	{
		if ($type && $type == 'procedures') {
			$file 		= $this->db->get_where('procedures', ['id' => $id])->row();
		}

		$history	= $this->db->order_by('updated_at', 'ASC')->get_where('directory_log', ['directory_id' => $id])->result();
		$jabatan 	= $this->db->get('tbl_jabatan')->result();

		$this->template->set('jabatan', $jabatan);
		$this->template->set('sts', $this->sts);
		$this->template->set('file', $file);
		$this->template->set('history', $history);
		$this->template->set('type', $type);
		$this->template->render('approval/approval-form');
	}

	public function save_approval()
	{
		$data = $this->input->post();
		if ($data) {
			$this->db->trans_begin();
			$this->Monitor_model->approval($data);
			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				$Return = [
					'status' => 0,
					'msg'	 => 'Failed upload document file. Please try again later.!'
				];
			} else {
				$this->db->trans_commit();
				$Return = [
					'status' => 1,
					'msg'	 => 'Success upload document file...'
				];
			}
		} else {
			$Return = [
				'status' => 0,
				'msg'	 => 'Data not valid.'
			];
		}

		echo json_encode($Return);
	}


	/* PUBLISHED PROCESS */
	public function publised()
	{
		/* CORRECTION */
		$procedures 	= $this->db->order_by('modified_at', 'DESC')->get_where('view_procedures', ['company_id' => $this->company, 'status' => 'PUB'])->result();
		$users = $this->db->get_where('users')->result();

		$ArrUsers = [];
		foreach ($users as $user) {
			$ArrUsers[$user->id_user] = $user;
		}

		$this->template->set([
			'title'			=> 'PUBLISHED PROCEDURES',
			'procedures' 	=> $procedures,
			'sts'			=> $this->sts,
			'ArrUsers'		=> $ArrUsers,
		]);
		$this->template->render('list');
	}

	public function print_document()
	{
		$this->load->library(array('Mpdf'));
		$folder = $_GET['p'];
		$file = $_GET['f'];

		$mpdf = new mPDF('', '', '', '', '', '', '', '', '', '');
		$mpdf->SetImportUse();
		$pagecount = $mpdf->SetSourceFile('directory/' . $folder . '/' . $file);
		$tplId = $mpdf->ImportPage($pagecount);
		$mpdf->UseTemplate($tplId);
		$mpdf->addPage();
		$mpdf->WriteHTML('Hello World');
		$newfile = 'directory/' . $folder . '/' . $file;
		$mpdf->Output(
			$newfile,
			'F'
		);
		$mpdf->Output();
	}

	public function picture()
	{
		$id 		= $this->input->post('id');
		$picture 	= $this->db->get_where('pictures', ['id' => $id])->row();

		$this->template->set('picture', $picture);
		$this->template->render('change-picture');
	}

	public function upload()
	{
		$old_picture 	= $this->input->post('old_picture');
		$id 			= $this->input->post('id');

		$config['upload_path']          = './assets/img/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 500;
		$config['max_width']            = 1000;
		$config['max_height']           = 1000;
		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if (!$this->upload->do_upload('picture')) {
			$error = $this->upload->display_errors();

			$collback = [
				'msg' => $error,
				'status' => 0
			];
			echo json_encode($collback);
			return FALSE;
		} else {
			if ($old_picture) {
				unlink('./assets/img/' . $old_picture);
			}
			$dataPicture = $this->upload->data();
			$picture = $dataPicture['file_name'];
		}

		$Arr_data = [
			'pictures' => $picture,
		];
		$this->db->trans_begin();
		$this->db->update('pictures', $Arr_data, ['id' => $id]);

		if ($this->db->trans_status() == false) {
			$this->db->trans_rollback();
			$collback = [
				'msg' => 'Upload Faild, Please ty again!',
				'status' => 0
			];
		} else {
			$this->db->trans_commit();
		}
		$collback = [
			'msg' => 'Upload Success!',
			'status' => 1,
			'picture' => $picture
		];

		echo json_encode($collback);
	}


	/* PUBLISHED PROCESS */
	public function revision()
	{
		/* CORRECTION */
		$procedures 	= $this->db->get_where('view_procedures', [
			'company_id' => $this->company, 'status' => 'RVI'
		])->result();
		$users = $this->db->get_where('users')->result();

		$ArrUsers = [];
		foreach ($users as $user) {
			$ArrUsers[$user->id_user] = $user;
		}

		$this->template->set([
			'title'			=> 'REVISION PROCEDURES',
			'procedures' 	=> $procedures,
			'sts'			=> $this->sts,
			'ArrUsers'		=> $ArrUsers,
		]);
		$this->template->render('list');
	}

	public function load_form_revision($id, $type = null)
	{
		$file 		= $this->db->get_where('procedures', ['id' => $id])->row();
		$history	= $this->db->order_by('updated_at', 'ASC')->get_where('directory_log', ['directory_id' => $id])->result();
		$this->template->set('sts', $this->sts);
		$this->template->set('file', $file);
		$this->template->set('type', $type);
		$this->template->set('history', $history);
		$this->template->render('revision-form');
	}

	public function save_revision()
	{
		$data = $this->input->post();
		if ($data) {
			$this->db->trans_begin();
			$data['status'] = 'RVI';
			$this->Monitor_model->revision($data);
			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				$Return = [
					'status' => 0,
					'msg'	 => 'Failed revision document file. Please try again later.!'
				];
			} else {
				$this->db->trans_commit();
				$Return = [
					'status' => 1,
					'msg'	 => 'Success revision document file...'
				];
			}
		} else {
			$Return = [
				'status' => 0,
				'msg'	 => 'Data not valid.'
			];
		}

		echo json_encode($Return);
	}
}

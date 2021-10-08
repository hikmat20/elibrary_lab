<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends Admin_Controller
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

		$this->load->model('dashboard/dashboard_model');
		$this->template->set_theme('dashboard');
		$this->template->page_icon('fa fa-dashboard');
		$this->prsh = $this->session->app_session['id_perusahaan'];
		$this->cbg = $this->session->app_session['id_cabang'];
	}

	public function index()
	{
		$this->template->set('title', 'Dashboard');
		//$data = $this->dashboard_model->monitor_eoq();

		//$data = $this->dashboard_model->where('qty<=minstok')->find_all();
		$open = $this->dashboard_model->meeting_open();
		$done = $this->dashboard_model->meeting_done();
		$close = $this->dashboard_model->meeting_close();
		$late = $this->dashboard_model->meeting_late();
		// $sum_penacc = $this->dashboard_model->pengajuan_acc();
		//$this->template->set('results', $data);
		$this->template->set('open', $open);
		$this->template->set('done', $done);
		$this->template->set('close', $close);
		$this->template->set('late', $late);
		//$this->template->set('sum_penacc', $sum_penacc);
		$this->template->render('index');
	}

	public function create_documents()
	{
		$this->template->set('title', 'Create Document');
		$id_jabatan = $this->session->app_session['id_jabatan'];
		$id_user 	= $this->session->app_session['id_user'];
		$doc1 = $this->db->get_where('gambar', ['nama_file !=' => null, 'id_perusahaan' => $this->prsh, 'id_cabang' => $this->cbg])->num_rows();
		$doc2 = $this->db->get_where('gambar1', ['nama_file !=' => null, 'id_perusahaan' => $this->prsh, 'id_cabang' => $this->cbg])->num_rows();
		$doc3 = $this->db->get_where('gambar2', ['nama_file !=' => null, 'id_perusahaan' => $this->prsh, 'id_cabang' => $this->cbg])->num_rows();
		$doc = $doc1 + $doc2 + $doc3;

		// koreksi
		$cor1 = $this->db->get_where('gambar', ['status_approve' => 0, 'prepared_by' => $id_user, 'nama_file !=' => null, 'id_perusahaan' => $this->prsh, 'id_cabang' => $this->cbg])->num_rows();
		$cor2 = $this->db->get_where('gambar1', ['status_approve' => 0, 'prepared_by' => $id_user, 'nama_file !=' => null, 'id_perusahaan' => $this->prsh, 'id_cabang' => $this->cbg])->num_rows();
		$cor3 = $this->db->get_where('gambar2', ['status_approve' => 0, 'prepared_by' => $id_user, 'nama_file !=' => null, 'id_perusahaan' => $this->prsh, 'id_cabang' => $this->cbg])->num_rows();

		// revisi
		$rev1 = $this->db->get_where('gambar', ['status_approve' => 1, 'id_review' => $id_jabatan, 'nama_file !=' => null, 'id_perusahaan' => $this->prsh, 'id_cabang' => $this->cbg])->num_rows();
		$rev2 = $this->db->get_where('gambar1', ['status_approve' => 1, 'id_review' => $id_jabatan, 'nama_file !=' => null, 'id_perusahaan' => $this->prsh, 'id_cabang' => $this->cbg])->num_rows();
		$rev3 = $this->db->get_where('gambar2', ['status_approve' => 1, 'id_review' => $id_jabatan, 'nama_file !=' => null, 'id_perusahaan' => $this->prsh, 'id_cabang' => $this->cbg])->num_rows();

		// approve
		$apv1 = $this->db->get_where('gambar', ['status_approve' => 2, 'id_approval' => $id_jabatan, 'nama_file !=' => null, 'id_perusahaan' => $this->prsh, 'id_cabang' => $this->cbg])->num_rows();
		$apv2 = $this->db->get_where('gambar1', ['status_approve' => 2, 'id_approval' => $id_jabatan, 'nama_file !=' => null, 'id_perusahaan' => $this->prsh, 'id_cabang' => $this->cbg])->num_rows();
		$apv3 = $this->db->get_where('gambar2', ['status_approve' => 2, 'id_approval' => $id_jabatan, 'nama_file !=' => null, 'id_perusahaan' => $this->prsh, 'id_cabang' => $this->cbg])->num_rows();

		$allCorr 	= $cor1 + $cor2 + $cor3;
		$allRev 	= $rev1 + $rev2 + $rev3;
		$allApv 	= $apv1 + $apv2 + $apv3;

		$pictures = $this->db->get('pictures')->result();
		$this->template->set('pictures', $pictures);
		$this->template->set('doc', $doc);
		$this->template->set('docCor', $allCorr);
		$this->template->set('docApv', $allApv);
		$this->template->set('docRev', $allRev);
		$this->template->render('create-document');
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
}

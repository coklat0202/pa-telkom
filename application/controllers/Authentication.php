<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authentication extends CI_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->model('Users');

    }

	public function index()	{
		$page_title = "Masuk Akun";
		$data = array(
			'page_title' => $page_title
		);

		$this->load->render('FE_PA/login', $data);
	}
	
	public function login()	{
		$result = $this->Users->login();
		if ($result['status']) {
			$this->session->set_userdata('user', $result['data']);
		}
		$this->output
                ->set_content_type('json')
                ->set_output(json_encode($result));
	}

	function logout() {
		$this->session->userdata = array();
        $this->session->sess_destroy();
		redirect(base_url('/'));
	}

	public function registrasi() {
		$page_title = "Daftar Akun Baru";
		$data = array(
			'page_title' => $page_title
		);

		$this->load->render('FE_PA/register', $data);
	}

	public function simpan() {
		$result = $this->Users->save();
		$this->output
                ->set_content_type('json')
                ->set_output(json_encode($result));
	}
}
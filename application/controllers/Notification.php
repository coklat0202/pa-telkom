<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends CI_Controller {
	public function __construct() {
        parent::__construct();
    }

	public function index()	{
		$page_title = "Kelola Notifikasi";
		$data = array(
			'page_title' => $page_title
		);

		$this->load->render('CMS_PA/kelola_notifikasi', $data);
	}
	
	public function konsul()	{
		$page_title = "Konsultasi";
		$data = array(
			'page_title' => $page_title
		);

		$this->load->render('CMS_PA/index_konsultasi', $data);
	}
	
	public function detail_konsul()	{
		$page_title = "Detail Konsultasi";
		$data = array(
			'page_title' => $page_title
		);

		$this->load->render('CMS_PA/detail_konsultasi', $data);
	}

	public function kelola_akun()	{
		$page_title = "Kelola Akun";
		$data = array(
			'page_title' => $page_title
		);

		$this->load->render('CMS_PA/kelola_akun', $data);
	}

	public function detail_history()	{
		$page_title = "Dtail History";
		$data = array(
			'page_title' => $page_title
		);

		$this->load->render('CMS_PA/detail_history_cetak', $data);
	}
}
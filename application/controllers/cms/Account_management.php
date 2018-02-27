<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Account_management extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Accounts', 'accounts');
        $user = $this->session->userdata('user');
        if (empty($user) || $user['level_user'] == 'user') {
            redirect('/');
        }
    }

    public function index() {
        $page_title = "Kelola Akun";
        $data = array(
            'page_title' => $page_title
        );

        $this->load->render('cms/account/account', $data);
    }

    public function get_accounts() {
        $list = $this->accounts->get_accounts();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $accounts) {
            $no++;
            $row = array();
            $row[] = $accounts->user_id;
            $row[] = $accounts->name;
            $row[] = $accounts->email;
            $row[] = $accounts->gender;
            $row[] = $accounts->born_date;
            $row[] = $accounts->username;
            $row[] = '<a href="#" class="delete-acc" id="' . $accounts->user_id . '" data-name="' . $accounts->username . '">Hapus</a>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->accounts->count_all(),
            "recordsFiltered" => $this->accounts->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function delete_account() {
        $result = $this->accounts->delete_account();
        $this->output
                ->set_content_type('json')
                ->set_output(json_encode($result));
    }

}

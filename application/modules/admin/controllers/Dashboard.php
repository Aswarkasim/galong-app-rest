<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('id_user') == "") {
            redirect('admin/auth');
        }
    }


    public function index()
    {
        $id_user = $this->session->userdata('id_user');
        $user = $this->Crud_model->listingOne('tbl_user', 'id_user', $id_user);

        $data = [
            'title'     => 'Dashboard',
            'user'      => $user,
            'content'   => 'admin/dashboard/indexs'
        ];

        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }
}

/* End of file Dashboard.php */

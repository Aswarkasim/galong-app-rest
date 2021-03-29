<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        if (($this->session->userdata('id_user') == "") || $this->session->userdata('role') != "Admin") {
            redirect('error_page');
        }
    }


    public function index()
    {
        $user = $this->Crud_model->listing('tbl_user');
        $data = [
            'add'      => 'admin/user/add',
            'edit'      => 'admin/user/edit/',
            'delete'      => 'admin/user/delete/',
            'user'      => $user,
            'content'   => 'admin/user/index'
        ];

        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    function userData()
    {

        $user = $this->Crud_model->listingUser();
        echo json_encode($user);
    }

    function add()
    {

        $valid = $this->form_validation;

        $valid->set_rules('nama_user', 'Nama User', 'required');
        $valid->set_rules('email', 'Email', 'required|is_unique[tbl_user.email]|valid_email');
        $valid->set_rules('password', 'Password', 'required');
        $valid->set_rules('re_password', 'Retype Password', 'required|matches[password]');

        if ($valid->run() === FALSE) {
            $data = [
                'title'     => 'Tambah User',
                'add'       => 'admin/user/add',
                'back'      => 'admin/user',
                'content'   => 'admin/user/add'
            ];
            $this->load->view('admin/layout/wrapper', $data, FALSE);
        } else {
            $i = $this->input;
            $data = [
                'nama_user'     => $i->post('nama_user'),
                'email'         => $i->post('email'),
                'password'      => sha1($i->post('password')),
                'role'          => $i->post('role'),
                'is_active'     => $i->post('is_aktif')
            ];
            $this->Crud_model->add('tbl_user', $data);
            $this->session->set_flashdata('msg', 'ditambah');
            redirect('admin/user/add', 'refresh');
        }
    }

    function edit($id_user)
    {
        $user = $this->Crud_model->listingOne('tbl_user', 'id_user', $id_user);

        $valid = $this->form_validation;

        $valid->set_rules('nama_user', 'Nama User', 'required');
        $valid->set_rules('email', 'Email', 'required|valid_email');
        $valid->set_rules('password', 'Password', 'matches[re_password]');
        $valid->set_rules('re_password', 'Retype Password', 'matches[password]');

        if ($valid->run() === FALSE) {
            $data = [
                'title'     => 'Edit ' . $user->nama_user,
                'edit'       => 'admin/user/edit/',
                'back'      => 'admin/user',
                'user'      => $user,
                'content'   => 'admin/user/edit'
            ];
            $this->load->view('admin/layout/wrapper', $data, FALSE);
        } else {
            $i = $this->input;

            $password = "";
            if ($i->post('password') != "") {
                $password = sha1($i->post('password'));
            } else {
                $password = $user->password;
            }
            $data = [
                'id_user'       => $id_user,
                'nama_user'     => $i->post('nama_user'),
                'email'         => $i->post('email'),
                'password'      => $password,
                'role'          => $i->post('role'),
                'is_active'     => $i->post('is_aktif')
            ];
            $this->Crud_model->edit('tbl_user', 'id_user', $id_user, $data);
            $this->session->set_flashdata('msg', 'diedit');
            redirect('admin/user/edit/' . $id_user, 'refresh');
        }
    }

    function delete($id_user)
    {
        $this->Crud_model->delete('tbl_user', 'id_user', $id_user);
        $this->session->set_flashdata('msg', 'dihapus');
        redirect('admin/user');
    }

    public function role()
    {
        $role = $this->Crud_model->listing('tbl_user_role');
        $data = [
            'add'       => 'roleAdd',
            'edit'      => 'roleEdit/',
            'delete'    => 'roleDelete/',
            'role'      => $role,
            'content'   => 'admin/role/index'
        ];
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }
}

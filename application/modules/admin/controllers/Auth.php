<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function index()
    {
        $valid = $this->form_validation;

        $valid->set_rules(
            'email',
            'Email',
            'required',
            array('required' => '%s harus diisi')
        );
        $valid->set_rules(
            'password',
            'Password',
            'required|min_length[6]',
            array(
                'required'     => 'Password harus diisi',
                'min_length'  => 'Password minimal 6 karakter'
            )
        );

        if ($valid->run() === FALSE) {
            $data = array(
                'title'     => 'Login Admin Ananda Private',
                'content'   => 'admin/auth/content/'
            );
            $this->load->view('admin/auth/login_admin', $data);
        } else {
            $i          = $this->input;
            $email      = $i->post('email');
            $password   = $i->post('password');
            $cek_login  = $this->Crud_model->login($email, $password);
            //print_r($email); die;

            if (!empty($cek_login) == 1) {
                $s = $this->session;
                $s->set_userdata('id_user', $cek_login->id_user);
                $s->set_userdata('email', $cek_login->email);
                $s->set_userdata('nama_user', $cek_login->nama_user);
                $s->set_userdata('is_active', $cek_login->is_active);
                $s->set_userdata('role', $cek_login->role);

                redirect(base_url('admin/dashboard'), 'refresh');
            } else {
                $data = array(
                    'title'     => 'Login Admin Ananda Private',
                    'error'     => 'Email atau password salah',
                    'content'   => 'admin/auth/content/'
                );
                $this->load->view('admin/auth/login_admin', $data);
            }
        }
    }

    function logout()
    {
        $s = $this->session;
        $s->unset_userdata('id_user');
        $s->unset_userdata('email');
        $s->unset_userdata('nama_user');
        $s->unset_userdata('role');
        $s->unset_userdata('is_active');
        redirect(base_url('admin/auth'), 'refresh');
    }
}

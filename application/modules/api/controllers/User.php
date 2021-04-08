<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class User extends REST_Controller
{

  public function __construct()
  {
    parent::__construct();

    $this->load->model('Crud_model');
  }


  public function index_get()
  {
    $id_user = $this->get('id_user');
    if ($id_user == '') {
      $user = $this->Crud_model->listing('tbl_user');
    } else {
      $user  = $this->Crud_model->listingOne('tbl_user', 'id_user', $id_user);
    }
    $this->response(['status' => 'success', 'error' => false, 'user' => $user], REST_Controller::HTTP_OK);
  }

  function index_put()
  {
    $id_user = $this->put('id_user');
    print_r($id_user);
    die;
    $data = [
      'id_user'            => $id_user,
      'username'      => $this->put('username'),
      'email'         => $this->put('email'),
      'namalengkap'   => $this->put('namalengkap'),
      'gender'        => $this->put('gender'),
      'nohp'          => $this->put('nohp'),
      'alamat'        => $this->put('alamat'),
      'no_ktp'        => $this->put('no_ktp')
    ];

    //$update = $this->Crud_model->edit('tbl_user', 'id_user', $id_user, $data);
    $this->db->where('id_user', $id_user);
    $update = $this->db->update('tbl_user', $data);
    if ($update) {
      $this->response($data, 202);
    } else {
      $this->response(array('status' => 'fail', 502));
    }
  }

  function index_delete()
  {
    $id_user = $this->delete('id_user');
    $this->db->where('id_user', $id_user);
    $delete = $this->db->delete('tbl_user');
    if ($delete) {
      $this->response(['status' => 'success'], 201);
    } else {
      $this->response(['status' => 'failed'], 502);
    }
  }


  function index_post()
  {
    $this->load->library('upload');

    $id_user = $this->post('id_user');
    $this->db->where('id_user', $id_user);
    $user = $this->db->get('tbl_user')->row();
    $gambar = $user->gambar;
    if (!empty($_FILES['gambar']['name'])) {
      $config['upload_path']   = './assets/uploads/images/';
      $config['allowed_types'] = 'gif|jpg|png|svg|jpeg';
      $config['max_size']      = '24000'; // KB 
      $this->upload->initialize($config);
      if (!$this->upload->do_upload('gambar')) {
        $this->response(
          [
            'status'    => 'failed',
            'error'     => true,
            'message'   => 'Select File'
          ],
          REST_Controller::HTTP_INTERNAL_SERVER_ERROR
        );
      } else {


        if ($user->gambar != "") {
          unlink($user->gambar);
        }

        $upload_data = ['uploads' => $this->upload->data()];
        $gambar  = $config['upload_path'] . $upload_data['uploads']['file_name'];
      }
    }


    $data = [
      'id_user'       => $id_user,
      // 'username'      => $this->post('username'),
      // 'email'         => $this->post('email'),
      'namalengkap'   => $this->post('namalengkap'),
      'gender'        => $this->post('gender'),
      'nohp'          => $this->post('nohp'),
      'alamat'        => $this->post('alamat'),
      'latitude'      => $this->post('latitude'),
      'longitude'     => $this->post('longitude'),
      'gambar'        => $gambar
    ];
    $this->db->where('id_user', $id_user);
    $update = $this->db->update('tbl_user', $data);

    // $this->db->where('id_user', $id_user);
    // $user = $this->db->get('tbl_user')->row();

    if ($update) {
      $this->response([
        'status'    => 'success',
        'error'     => false,
        'message'   => 'Sukses mengubah data',
        'data'      => $data
      ], REST_Controller::HTTP_OK);
    } else {
      $this->response([
        'status'    => 'failed',
        'error'     => true,
        'message'   => 'Gagal mengubah data'
      ], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
    }
  }
}

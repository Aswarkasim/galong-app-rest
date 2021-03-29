<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';


class Auth extends REST_Controller
{


  public function __construct()
  {
    parent::__construct();
  }


  public function index_post()
  {
    $data = [
      'username'    => $this->post('username'),
      'password'    => sha1($this->post('password'))
    ];
    $this->db->where($data);
    $user = $this->db->get('tbl_user')->row();

    if (!empty($user)) {
      $this->response([
        'status'    => 'success',
        'error'     => false,
        'user'      => $user
      ], REST_Controller::HTTP_OK);
    } else {
      $this->response([
        'status'  => 'failed',
        'error'   => true
      ], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
    }
  }

  function register_post()
  {

    $this->load->helper('string');
    $this->load->model('api/Api_model', 'API');
    $data = [
      'id_user'     => $this->post('id_user'),
      'username'    => $this->post('username'),
      'password'    => sha1($this->post('password')),
      'role'        => 'user'
    ];

    $userCek = $this->API->cekUsername($data['username']);

    if ($userCek == null) {

      $insert  = $this->db->insert('tbl_user', $data);

      if ($insert) {
        $this->response([
          'status'    => 'success',
          'message'   => 'Sukses menambahkan data',
          'error'     => false,
          'user'      => $data
        ], REST_Controller::HTTP_OK);
      } else {
        $this->response([
          'status'  => 'failed',
          'message'   => 'Gagal menambahkan data',
          'error'   => true
        ], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
      }
    } else {
      $this->response([
        'status'  => 'failed',
        'message'   => 'Nama user telah ada',
        'error'   => true
      ], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
    }
  }

  function next_post()
  {
    $this->load->library('upload');

    $id_user = $this->post('id_user');

    $gambar = '';
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

        $upload_data = ['uploads' => $this->upload->data()];
        $gambar  = $config['upload_path'] . $upload_data['uploads']['file_name'];
      }
    }

    $data = [
      'id_user'       => $id_user,
      'alamat'        => $this->post('alamat'),
      'namalengkap'        => $this->post('namalengkap'),
      'email'        => $this->post('email'),
      'no_hp'        => $this->post('no_hp'),
      'role'        => 'user',
      'latitude'        => $this->post('latitude'),
      'longitude'        => $this->post('longitude'),
      'is_active'        => 1,
      'gambar'          => $gambar
    ];
    $this->db->where('id_user', $id_user);
    $this->db->update('tbl_user', $data);

    $this->response([
      'status'    => 'success',
      'error'     => false,
      'message'   => 'Sukses mengubah data',
      'data'      => $data
    ], REST_Controller::HTTP_OK);
  }
}

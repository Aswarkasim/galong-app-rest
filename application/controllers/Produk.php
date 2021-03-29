<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_CONTROLLER.php';
class Produk extends REST_Controller
{


  public function __construct()
  {
    parent::__construct();
  }

  public function index_get()
  {
    $id = $this->get('id');
    if ($id == '') {
      $produk = $this->db->get('produk')->result();
    } else {
      $this->db->where('id', $id);
      $produk = $this->db->get('produk')->result();
    }
    $this->response($produk, REST_Controller::HTTP_OK);
  }

  function index_post()
  {
    $data = [
      'nama_produk'   => $this->post('nama_produk'),
      'tipe_produk'   => $this->post('tipe_produk'),
      'stok'          => $this->post('stok'),
      'harga'         => $this->post('harga'),
    ];

    $insert = $this->db->insert('produk', $data);
    if ($insert) {
      $this->response($data, REST_Controller::HTTP_OK);
    } else {
      $this->response(array('status' => 'fail', 502));
    }
  }

  function index_put()
  {
    $id = $this->put('id');
    $data = [
      'nama_produk'   => $this->put('nama_produk'),
      'tipe_produk'   => $this->put('tipe_produk'),
      'stok'          => $this->put('stok'),
      'harga'         => $this->put('harga'),
    ];
    $this->db->where('id', $id);
    $update = $this->db->update('produk', $data);
    if ($update) {
      $this->response($data, 200);
    } else {
      $this->response(array('status' => 'fail', 502));
    }
  }

  function index_delete()
  {
    $id = $this->delete('id');
    $this->db->where('id', $id);
    $delete = $this->db->delete('produk');
    if ($delete) {
      $this->response(['status' => 'success'], 201);
    } else {
      $this->response(['status' => 'failed'], 502);
    }
  }
}

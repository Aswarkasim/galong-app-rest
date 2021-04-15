<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';


class Order extends REST_Controller
{


  public function __construct()
  {
    parent::__construct();
  }

  public function index_get()
  {
    $id_user = $this->get('id_user');

    if ($id_user) {
      $this->db->where('id_user', $id_user);
      $this->db->where('is_done', '0');
      $this->db->order_by('date_created', 'DESC');
      $order = $this->db->get('tbl_order')->result();
    } else {
      $this->db->where('id_driver', null);
      $this->db->where('is_done', '0');
      $this->db->order_by('date_created', 'ASC');
      $order = $this->db->get('tbl_order')->result();
    }

    $this->success_response('order', $order);
  }

  function index_post()
  {

    $this->load->helper('string');
    $data = [
      'id_order'    => random_string(),
      'id_user'     => $this->post('id_user'),
      'alamat'      => $this->post('alamat'),
      'harga'       => $this->post('harga'),
      'jumlah'       => $this->post('jumlah'),
      'lat'         => $this->post('lat'),
      'lng'         => $this->post('lng'),
      'is_get'      => 0,
      'is_delivery' => 0,
      'is_done'     => 0,
    ];
    $insert = $this->db->insert('tbl_order', $data);

    if ($insert) {
      $this->success_response('order', $data);
    } else {
      $this->failed_response('gagal mengubah data');
    }
  }

  function is_getdriver_put()
  {
    $id_order = $this->put('id_order');
    $data = [
      'id_driver' => $this->put('id_driver')
    ];

    $this->is_one($id_order, $data);
  }

  function is_delivery_put()
  {
    $id_order = $this->put('id_order');
    $data = [
      'is_delivery' => $this->put('is_delivery')
    ];

    $this->is_one($id_order, $data);
  }

  function is_done_put()
  {
    $id_order = $this->put('id_order');
    $data = [
      'is_done' => $this->put('is_done')
    ];

    $this->is_one($id_order, $data);
  }

  private function is_one($id_order, $data)
  {
    if ($id_order != null) {
      $this->db->where('id_order', $id_order);
      $update = $this->db->update('tbl_order', $data);
      if ($update) {
        $this->success_response('order', $data);
      } else {
        $this->failed_response('gagal mengubah data');
      }
    } else {
      $this->failed_response('id order null');
    }
  }

  private function success_response($field, $data)
  {
    $response = [
      'status'  => 'success',
      'error'   => false,
      $field   => $data
    ];
    $this->response($response, REST_Controller::HTTP_OK);
  }


  private function failed_response($message)
  {
    $response = [
      'status'  => 'failed',
      'error'   => true,
      'message' => $message
    ];
    $this->response($response, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
  }
}

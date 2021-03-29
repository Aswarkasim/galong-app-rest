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
    $id_driver = $this->get('id_driver');
    if (($id_user != '') || $id_user != null) {
      $order = $this->db->get('tbl_order');
    } else if (($id_driver != '') || $id_driver != null) {
      $this->db->where('id_user_driver');
    }
  }
}

<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Api_model extends CI_Model
{

  function cekUsername($username)
  {
    return $this->db->select('*')
      ->from('tbl_user')
      ->where('username', $username)
      ->get()->result();
  }

  function getOrderDriver($id_driver = null)
  {
    $this->db->select('tbl_order.*, tbl_user.namalengkap')
      ->join('tbl_user', 'tbl_user.id_user = tbl_order.id_user', 'left')
      ->where('id_driver', $id_driver)
      ->where('is_done', '0')
      ->order_by('tbl_order.date_created', 'ASC');
    return $this->db->get()->result();
  }
}

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
}

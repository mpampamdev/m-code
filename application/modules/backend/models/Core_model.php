<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Core_model extends MY_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function get_main_menu($is_parent = 0)
  {
     $this->db->where("is_parent",$is_parent);
     $this->db->where("is_active","1");
     $this->db->order_by("sort","ASC");
     return $this->db->get("main_menu");
  }

}

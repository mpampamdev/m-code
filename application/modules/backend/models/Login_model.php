<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/* dev : mpampam*/
/* fb : https://facebook.com/mpampam*/
/* fanspage : https://web.facebook.com/programmerjalanan*/
/* web : www.mpampam.com*/
/* Generate By M-CRUD Generator 10/11/2020 14:51*/
/* Please DO NOT modify this information */
class Login_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function get_data($email)
  {
    $qry = $this->db->select("auth_user.id_user,
                              auth_user.email,
                              auth_user.password,
                              auth_user.token,
                              auth_user.is_active,
                              auth_user.is_delete,
                              auth_user.created")
                    ->from("auth_user")
                    ->where("auth_user.email","$email")
                    ->where("auth_user.is_active","1")
                    ->where("auth_user.is_delete","0")
                    ->get();
    return $qry;
  }

}

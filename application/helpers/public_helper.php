<?php defined('BASEPATH') OR exit('No direct script access allowed');


function sess($str)
{
  $ci =  &get_instance();
  return $ci->session->userdata($str);
}


function setting($kd = null , $field = "value")
{
  $ci =  &get_instance();
  $kd = strtolower($kd);
  $qry = $ci->db->get_where("setting", ["options" => $kd]);
  if ($qry->num_rows() > 0) {
    return $qry->row()->$field;
  }else {
    return "System not available";
  }
}

function randomKey($length = 32)
{
  $ci =  &get_instance();
  return bin2hex($ci->encryption->create_key($length));
}


function readJSON($path)
{
    $string = file_get_contents($path);
    $obj = json_decode($string);
    return $obj;
}

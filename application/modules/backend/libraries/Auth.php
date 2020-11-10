<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * mpampam.com
 */
class Auth
{
  private $CI;

  private $group_id = null;
  private $user_id = null;


  function __construct()
  {
    $this->CI =& get_instance();
    $this->CI->load->model("Core_model");
  }


  function is_allowed($params)
  {
    $allowed = false;
    $group_id = profile('id_group');

    if ($group_id == 1) {
      $allowed = true;
    }else {
      $perms = $this->CI->model->get_data("auth_permission",["permission"=>$params]);
      $perms_id = $perms->row()->id;

      $cek_permission_to_group = $this->CI->model->get_data("auth_permission_to_group", ['group_id' => $group_id, 'permission_id' => $perms_id]);
      if ($cek_permission_to_group->num_rows() > 0) {
        $allowed = true;
      }else {
        $allowed = false;
      }

    }

    return $allowed;

  }

  function created_permission($params)
  {
    $perms = $this->CI->model->get_data("auth_permission",["permission"=>$params]);
    if ($perms->num_rows() < 1 ) {
        $perm_tmp_arr = explode('_', $params);
        $save = ["permission" => $params,
                 "definition" => "Module ".$perm_tmp_arr[0]
                ];
        $this->CI->db->insert("auth_permission", $save);
        return $this->CI->db->insert_id();
    }else {
        return false;
    }
  }

}

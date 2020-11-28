<?php defined('BASEPATH') OR exit('No direct script access allowed');
if(!function_exists('is_allowed')) {
	function is_allowed($permission = '') {
		$ci =& get_instance();
		if ($permission == '') {
	    die("parameter `is_allowed` not empty");
	  }else {
	    $ci->load->library("auth");
	    $ci->auth->created_permission($permission);
	    if ($ci->auth->is_allowed($permission)) {
	      return true;
	    }else {
	      return false;
	    }
	  }
	}
}

if(!function_exists('set_message')) {
	function set_message($type = 'info', $message = null) {
		$ci =& get_instance();
		$ci->session->set_flashdata('t_message', $message);
    $ci->session->set_flashdata('t_type', $type);
	}
}


if(!function_exists('profile')) {
	function profile($field)
	{
	  $ci=& get_instance();
	  $qry = $ci->db->select("auth_user_to_group.id_user AS id_user,
	                          auth_user_to_group.id_group AS id_group,
	                          auth_user.`name` AS name,
	                          auth_user.email AS email,
	                          auth_user.`password` AS password,
	                          auth_user.token AS token,
														auth_user.photo AS photo,
	                          auth_user.is_active AS is_active,
														auth_user.last_login AS last_login,
	                          auth_user.created AS created,
	                          auth_user.modified AS modified,
	                          auth_user.is_delete AS is_delete,
	                          auth_group.`group` AS group,
	                          auth_group.definition AS definition_group")
	                  ->from("auth_user_to_group")
	                  ->join("auth_user","auth_user.id_user = auth_user_to_group.id_user","left")
	                  ->join("auth_group","auth_group.id = auth_user_to_group.id_group","left")
	                  ->where("auth_user_to_group.id_user",sess("id_user"))
	                  ->get()
	                  ->row();
	    return $qry->$field;
	}
}

if (!function_exists('cclang'))
{
    function cclang($langkey = null, $params = [])
    {
    	if (!is_array($params)) {
    		$params = [$params];
    	}

        $lang = lang($langkey);

        $idx = 1;
        foreach ($params as $value) {
        	$lang = str_replace('$'.$idx++, $value, $lang);
        }

        $lang = preg_replace('/\$([0-9])/', '', $lang);

        if (!$lang) {
        	return ucwords($langkey);
        }

        return $lang;
    }
}



//pass hash
if(!function_exists('pass_encrypt')) {
	function pass_encrypt($token,$str)
	{
	    $ecrypt = password_hash($str."".$token,PASSWORD_DEFAULT);
	    return $ecrypt;
	}
}

if(!function_exists('pass_decrypt')) {
	function pass_decrypt($token,$str,$hash)
	{
	    if (password_verify($str."".$token, $hash)) {
	        return true;
	    }else {
	        return false;
	    }
	}
}

if(!function_exists('get_url')) {
	function get_url($params = "pagenotfound")
	{
		return site_url(ADMIN_ROUTE."/$params");
	}
}

if(!function_exists('url')) {
	function url($params = "pagenotfound")
	{
		return site_url(ADMIN_ROUTE."/$params");
	}
}


function dateTimeFormat($str)
{
	$date = date("Y-m-d", strtotime($str));
	$time = date("H:i", strtotime($str));
	return $date."T".$time;
}

function changeText($str)
{
	$text ='';
	$arr = explode("_",$str);
	for ($i=1; $i < count($arr) ; $i++) {
		$text.= $arr[$i]." ";
	}

	// $exp = implode(" ",$text);

	return ucwords($text);

}



//combobox
if(!function_exists('is_combo')) {
	function is_combo($table,$id_name,$id_field,$name_field,$value)
	{
	  $ci=& get_instance();
	  $qry = $ci->db->get_where("$table",["id !="=>"1"]);
	  $str = '<select class="form-control" name="'.$id_name.'" id="'.$id_name.'">';
	  $str .= '<option value="">-- Select --</option>';
	  foreach ($qry->result() as $row) {
	    $str .='<option value="'.$row->$id_field.'" ';
	    $str .=  $value==$row->$id_field ? "selected>":">";
	    $str .= $row->$name_field;
	    $str .='</option>';
	  }
	  $str .= '<select>';

	  return $str;
	}
}

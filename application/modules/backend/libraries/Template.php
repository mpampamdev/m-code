<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * mpampam.com
 */
class Template
{
  private $CI;

  private $temp_title = null ;


  function __construct()
  {
    $this->CI =& get_instance();
    $this->CI->load->model("Core_model");
  }


  public function set_title($title)
  {
    $this->temp_title = $title;
  }

  public function  view($view_name, $params = array(),$default=true)
  {
    // if ($this->CI->userize->init()) {
      if ($default) {
        $header_params['title_module'] = $this->temp_title;
        $header_params['main_menu'] = $this->CI->load->view("backend/menu",[],true);
        $this->CI->load->view('header',$header_params);
        // $this->CI->load->view(config_item("cpanel").'sidebar',$header_params);
        if (profile("id_group") != 1) {
          if (setting("maintenance_status") == "Y") {
            $this->CI->load->view("backend/content/core/maintenance");
          }else {
            $this->CI->load->view($view_name,$params);
          }
        }else {
          $this->CI->load->view($view_name,$params);
        }
        $this->CI->load->view('footer');
      }else {
        $this->CI->load->view($view_name,$params);
      }
    // }else {
    //   $this->CI->load->view("403");
    // }


  }



} //end class Template

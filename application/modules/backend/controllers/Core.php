<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* dev : mpampam*/
/* fb : https://facebook.com/mpampam*/
/* fanspage : https://web.facebook.com/programmerjalanan*/
/* web : www.mpampam.com*/
/* Generate By M-CRUD Generator 10/11/2020 14:51*/
/* Please DO NOT modify this information */


class Core extends Backend{

  public function __construct()
  {
    parent::__construct();
    $this->load->model("Core_model","model");
  }

  function reset_password()
  {
    $this->template->view("content/core/form_reset_password",array(),false);
  }


  function reset_password_action()
  {
    if ($this->input->is_ajax_request()) {
          $json = array('success'=>false, 'alert'=>array());
          $this->form_validation->set_rules("password","Password","trim|xss_clean|required|callback__cek_password");
          $this->form_validation->set_rules("password_baru","New password","trim|xss_clean|required|min_length[6]");
          $this->form_validation->set_rules("konfirmasi_password","Password confirm","trim|xss_clean|matches[password_baru]");
          $this->form_validation->set_error_delimiters('<span class="error text-danger" style="font-size:11px">','</span>');
          if ($this->form_validation->run()) {
            $token = randomKey();
            $update = array(
                            'token' => $token,
                            'password' => pass_encrypt($token,$this->input->post('konfirmasi_password')),
                          );

            $this->model->get_update("auth_user",$update,["id_user" => sess("id_user")]);

            $json['alert'] = "Change password successfully";
            $json['success'] =  true;
          }else {
            foreach ($_POST as $key => $value)
              {
                $json['alert'][$key] = form_error($key);
              }
          }
          return $this->response($json);
      }
  }


  function icon()
  {
    $this->template->view("content/core/icon",array(),false);
  }

  function notPermission()
  {
    $this->template->set_title("Error 403 - do not have permission");
    $this->template->view("backend/content/core/error403");
  }

  function pagenotfound()
  {
    $this->template->set_title("Error 404 - Page Not Found");
    $this->template->view("backend/content/core/error404");
  }


  function maintenance()
  {
    $this->template->set_title("Maintenance");
    $this->template->view("backend/content/core/maintenance");
  }

}

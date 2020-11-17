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
          $this->form_validation->set_rules("password","*&nbsp;","trim|xss_clean|required|callback__cek_password");
          $this->form_validation->set_rules("password_baru","*&nbsp;","trim|xss_clean|required|min_length[6]");
          $this->form_validation->set_rules("konfirmasi_password","*&nbsp;","trim|xss_clean|matches[password_baru]");
          $this->form_validation->set_error_delimiters('<span class="error text-danger" style="font-size:11px">','</span>');
          if ($this->form_validation->run()) {
            $token = randomKey();
            $update = array(
                            'token' => $token,
                            'password' => pass_encrypt($token,$this->input->post('konfirmasi_password')),
                          );

            $this->model->get_update("user",$update,["id_user" => sess("id_user")]);

            $json['alert'] = "reset password successfully";
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

  function imageUploadEditor()
  {
        $this->load->helper('file');
        $max_upload = $this->config->item('max_upload');

        $dir = sess('id_user')."-".sha1(date("Y-m-d"));
        $path = FCPATH . '/_temp/uploads/tmp';

        if (is_dir($path."/".$dir)) {
          delete_files($path."/".$dir);
        }else {
          mkdir($path."/".$dir, 0777);
        }

        $config = [
        'upload_path' 		=> './_temp/uploads/tmp/' . $dir . '/',
        'allowed_types' 	=> 'png|jpeg|jpg|gif',
        'max_size'  		  => $max_upload,
        'max_filename'    => '20'
      ];

      $this->load->library('upload', $config);

      if ($this->upload->do_upload('file')){
        $upload_data = $this->upload->data();
        $file_name 	= $upload_data['file_name'];
        $file = $this->imageCopy($file_name, $dir, "Text editor (summernote)");
        $json['success'] = true;
        $json['file'] = base_url()."_temp/uploads/img/".$file;
      }else {
        $json['success'] = false;
        $json['msg'] = "Format FIle : png | jpeg | jpg | gif , Max file upload $max_upload Kb";
      }

      echo json_encode($json);
  }

  // function imageRemoveEditor()
  // {
  //   $src = $this->input->post('src');
  //   $file_name = str_replace(base_url()."_temp/uploads/img/", '', $src);
  //   if(unlink("./_temp/uploads/img/".$file_name)){
  //     $this->db->where('file_name', $file_name);
  //     $this->db->delete('filemanager');
  //   }
  // }


  function icon()
  {
    $this->template->view("content/core/icon",array(),false);
  }

  function notPermission()
  {
    $this->template->set_title("Error 403 - do not have permission");
    $this->template->view("backend/content/core/error403");
  }


  function maintenance()
  {
    $this->template->set_title("Maintenance");
    $this->template->view("backend/content/core/maintenance");
  }

}

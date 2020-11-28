<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/* dev : mpampam*/
/* fb : https://facebook.com/mpampam*/
/* fanspage : https://web.facebook.com/programmerjalanan*/
/* web : www.mpampam.com*/
/* Please DO NOT modify this information */


class Backend extends CI_Controller{

  private $title = 'title';

  public function __construct($config = array())
  {
    parent::__construct();
    foreach ($config as $key => $val) {
      if(isset($this->$key))
                $this->$key = $val;
    }

    if (!$this->session->userdata("login_status")) {
        redirect(site_url("backend/login"),"refresh");
    }else {
      $this->load->library(array("backend/Template","backend/Userize","form_validation","security","user_agent","Encryption","My_encrypt"));
      $this->load->helper(array("app","sct","public","language"));
      $this->lang->load("app",$this->config->item("language"));
      if (setting("user_log") == "Y") {
        $this->getlog();
      }
    }
  }


  public function response($data, $status = 200)
  {
      // $data['csrf_name'] = $this->security->get_csrf_token_name();
      // $data['csrf_token'] = $this->security->get_csrf_hash();

      header('Content-type:application/json');
      die(json_encode($data));
      $this->output
          ->set_content_type('application/json')
          ->set_status_header($status)
          ->set_output(json_encode($data));
  }

  function error404()
  {
    $this->template->set_title("Error 404 - Page Not Found");
    $this->template->view("backend/content/core/error404");
  }

  function imageUpload()
  {
    if ($this->input->is_ajax_request()) {
      $json = array('success' => false );
      $this->load->helper('file');
      $max_upload = $this->config->item('max_upload');
      // $hash = sha1()
      if (!empty($_FILES['file']['name'])) {
          if ($_FILES['file']['size'] <= $max_upload."000") {
            $dir = sess('id_user')."-".sha1(date("YmdHis"));
            $path = FCPATH . '/_temp/uploads/tmp';

            if (is_dir($path."/".$dir)) {
              delete_files($path."/".$dir);
            }else {
              mkdir($path."/".$dir, 0777);
            }

            // if (!is_dir($path."/".$dir)) {
            //   mkdir($path."/".$dir, 0777);
            // }

            $config = [
      			'upload_path' 		=> './_temp/uploads/tmp/' . $dir . '/',
      			'allowed_types' 	=> 'png|jpeg|jpg|gif|ico',
      			'max_size'  		  => $max_upload,
            'max_filename'    => '20'
      		];

      		$this->load->library('upload', $config);

          if ($this->upload->do_upload('file')){
            $upload_data = $this->upload->data();
            $json = [
      				'file_name' 	=>  $upload_data['file_name'],
              'file_dir'   => $dir,
              'success'     =>true
      			];
      		}else {
            $json = [
      				'msg' 	=>  $this->upload->display_errors()
      			];
          }
          }else {
            $json['msg'] 	=  "Max file upload $max_upload Kb";
          }
      }else {
        $json['select'] = false;
        $json['success'] = true;
      }
      return $this->response($json);
    }
  }


  function imageCopy($img_name = null , $file_dir = '', $title="")
  {
    if (isset($_POST['file-dir'])) {
      $file_dir = $_POST['file-dir'];
    }

    if (!empty($file_dir)) {
      if (!empty($img_name)) {
        $image_copy = date("dmyHis") . '_' . str_replace("-","_",$img_name);
          rename(FCPATH . '/_temp/uploads/tmp/' . $file_dir . '/' . $img_name,
                 FCPATH . '/_temp/uploads/img/' . $image_copy);

          rmdir(FCPATH . '/_temp/uploads/tmp/' . $file_dir);

          if (!is_file(FCPATH . '/_temp/uploads/img/' . $image_copy)) {
            return $this->response([
              'alert' => 'Error uploading image'
              ]);
            exit();
          }


          if ($this->uri->segment(2)!= "filemanager") {
            $this->db->insert("filemanager",[ "file_name" => $image_copy,
                                              "ket" => "Di upload melalui module ".($title=="" ? $this->title : $title),
                                              "created" => date("Y-m-d H:i")
                                            ]);
          }

        return $image_copy;
      }else {
        return $img_name;
      }
    }else {
      return $img_name;
    }
  }


  function imageRemove($img = null, $ajax = true)
  {
    $json['success'] = false;
    if ($this->input->post("img")) {
      $img = $this->input->post("img");
    }

    if (!empty($img)) {
        if (file_exists(FCPATH ."/_temp/uploads/img/".$img)) {
          unlink(FCPATH ."/_temp/uploads/img/".$img);
          $json['success'] = true;
        }
    }

    if ($ajax) {

      echo json_encode($json);
    }else {
      return true;
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
        $file = $this->imageCopy($file_name, $dir, "$this->title (text-editor)");
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


function is_allowed($permission = null, $redirect = true)
{
  if ($permission == null) {
    die("parameter `is_allowed` not empty");
  }else {
    $this->load->library("auth");
    $this->auth->created_permission($permission);
    if ($this->auth->is_allowed($permission)) {
      return true;
    }else {
      if ($redirect) {
        redirect(site_url(ADMIN_ROUTE."/core/notPermission"));
      }
      return false;
    }
  }
}

  //CEK PASSWORD FORM VALIDATION
function _cek_password($str)
{
  if ($str!="") {
    if (pass_decrypt(profile("token"),$str,profile("password"))) {
      return true;
    }else {
      $this->form_validation->set_message('_cek_password', '%s Invalid');
      return false;
    }
  }else {
    return true;
  }
}


 function getlog()
 {

   $post = $_POST;
   $postman = json_encode($post)!= "[]" ? json_encode($post):null;
   if (!array_key_exists("draw",$post)) {
     $data = array('user' => profile("id_user"),
                   'controller' => $this->title,
                   'url' => $_SERVER['REQUEST_URI'],
                   'ip_address' => $this->input->ip_address(),
                   'data' => $postman,
                   'created_at' => date("Y-m-d H:i:s")
                   );
     $this->db->insert("ci_user_log",$data);
     return true;
   }
 }

}

// end class backend


/**
 * public
 */
// class Pbl extends CI_Controller{
//   public function __construct()
//   {
//     parent::__construct();
//     $this->load->library(array("public/Template"));
//     $this->load->helper(array("public","public/main_menu"));
//     if (config_system("maintenance","status")=="1") {
//         echo "maintenance";
//         die();
//     }
//   }
// }

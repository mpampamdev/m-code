<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* dev : mpampam*/
/* fb : https://facebook.com/mpampam*/
/* fanspage : https://web.facebook.com/programmerjalanan*/
/* web : www.mpampam.com*/
/* Generate By M-CRUD Generator 10/11/2020 14:51*/
/* Please DO NOT modify this information */


class User extends Backend{

  private $title = "User";

  public function __construct()
  {
    $config = array(
      'title' => $this->title,
		 );
		parent::__construct($config);
    $this->load->model("User_model","model");
  }

  function index()
  {
    $this->is_allowed('user_list');
    $this->template->set_title("User");
    $this->template->view("content/user/index");
  }


  function json()
  {
    if ($this->input->is_ajax_request()) {
      if (!is_allowed('user_list')) {
        show_error("Access Permission", 403,'403::Access Not Permission');
        exit();
      }

      $list = $this->model->get_datatables();
      $data = array();
      // $no = $_POST['start'];
      foreach ($list as $rows) {
          $row = array();
          $row[] = imgView($rows->photo);
          $row[] = $rows->name;
          $row[] = $rows->email;
          $row[] = $rows->group == "" ? '<i>Null</i>':ucfirst($rows->group);
          $row[] = $rows->is_active == 1 ? '<i class="mdi mdi-eye text-success"></i> Y' : '<i class="mdi mdi-eye-off text-danger"></i> N';
          $row[] = $rows->created == "" ? "null":date("d/m/Y H:i",strtotime($rows->created));
          $row[] = $rows->last_login == "" ? "null":date("d/m/Y H:i",strtotime($rows->last_login));
          $row[] = '
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="'.url("user/view/".enc_url($rows->id_user)).'" id="view" class="btn btn-primary" title="'.cclang("detail").'">
                          <i class="ti-file"></i>
                        </a>
                        <a href="'.url("user/update/".enc_url($rows->id_user)).'" id="edit" class="btn btn-warning" title="'.cclang("update").'">
                          <i class="ti-pencil"></i>
                        </a>
                        <a href="'.url("user/delete/".enc_url($rows->id_user)).'" '.($rows->id_user == 1 ? "style='display:none'":"").' id="delete" class="btn btn-danger" title="'.cclang("delete").'">
                          <i class="ti-trash"></i>
                        </a>
                      </div>
                   ';
          $data[] = $row;
      }

      $output = array(
                      "draw" => $_POST['draw'],
                      "recordsTotal" => $this->model->count_all(),
                      "recordsFiltered" => $this->model->count_filtered(),
                      "data" => $data,
              );
      //output to json format
      return $this->response($output);
    }
  }

  function _rules()
   {
     $this->form_validation->set_rules("nama","*&nbsp;","trim|xss_clean|htmlspecialchars|required");
     $this->form_validation->set_rules("id_group","*&nbsp;","trim|xss_clean|numeric|required");
     $this->form_validation->set_rules("email","*&nbsp;","trim|xss_clean|valid_email|required|callback__cek_email");
     $this->form_validation->set_rules("is_active","*&nbsp;","trim|xss_clean|numeric|required");
     $this->form_validation->set_rules('photo', '*&nbsp;', 'trim|xss_clean');
     if ($_POST['submit']=="save") {
       $this->form_validation->set_rules("password","*&nbsp;","trim|xss_clean|required|min_length[6]");
       $this->form_validation->set_rules("konfirmasi_password","*&nbsp;","trim|xss_clean|matches[password]|required");
     }

     if ($_POST['submit']=="update") {
       $this->form_validation->set_rules("password","*&nbsp;","trim|xss_clean|min_length[6]");
       $this->form_validation->set_rules("konfirmasi_password","*&nbsp;","trim|xss_clean|matches[password]");
     }

     $this->form_validation->set_error_delimiters('<span class="error text-danger" style="font-size:11px">','</span>');
   }


function add()
{
  $this->is_allowed('user_add');
  $this->template->set_title(cclang("add")." user");
  $data = array('action' => url("User/add_action"),
                'button' => "save",
                'nama' => set_value("nama"),
                'email' => set_value("email"),
                'is_active' => set_value("is_active"),
                'file_name' => set_value("file_name"),
                'id_group' => set_value("id_group"),
                );
  $this->template->view("content/user/form",$data);
}

function add_action()
{
  if ($this->input->is_ajax_request()) {
    if (!is_allowed('user_add')) {
      show_error("Access Permission", 403,'403::Access Not Permission');
      exit();
    }

        $json = array('success'=>false, 'alert'=>array());
        $this->_rules();
        if ($this->form_validation->run()) {
          $token =  randomKey();
          $insert = array('name' => $this->input->post('nama',true),
                          'email' => $this->input->post('email'),
                          'is_active' => $this->input->post('is_active'),
                          'token' => $token,
                          'photo' =>  $this->imageCopy($this->input->post('photo',true)),
                          'password' => pass_encrypt($token,$this->input->post('konfirmasi_password')),
                          'is_delete' => "0",
                          'created' => date('Y-m-d H:i:s'),
                        );

          $this->model->get_insert("auth_user",$insert);

          $last_id_user = $this->db->insert_id();

          $insert_trans = array('id_user' => $last_id_user,
                                'id_group' => $this->input->post('id_group')
                              );

          $this->model->get_insert("auth_user_to_group",$insert_trans);

          set_message("success",cclang("notif_save"));
          $json['redirect'] = url("user");
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



function update($id)
{
  $this->is_allowed('user_update');
  if ($row = $this->model->get_where_data(dec_url($id))) {
    $this->template->set_title(cclang("update")." User");
    $data = array('action' => url("User/update_action/$id"),
                  'button' => "update",
                  'nama' => set_value("nama",$row->name),
                  'email' => set_value("email",$row->email),
                  'file_name' => set_value("file_name",$row->photo),
                  'is_active' => set_value("is_active",$row->is_active),
                  'id_group' => set_value("id_group",$row->id_group),
                  );
    $this->template->view("content/user/form",$data);
  }else {
    $this->error404();
  }
}

function update_action($id)
{
  if ($this->input->is_ajax_request()) {
    if (!is_allowed('user_update')) {
      show_error("Access Permission", 403,'403::Access Not Permission');
      exit();
    }
        $json = array('success'=>false, 'alert'=>array());
        $this->_rules();
        if ($this->form_validation->run()) {

          if ($_POST['konfirmasi_password']!="") {
            $token =  randomKey();
            $update['token'] = $token;
            $update['password'] = pass_encrypt($token,$this->input->post('konfirmasi_password'));
          }

          $update['name'] = $this->input->post('nama',true);
          $update['email'] = $this->input->post('email');
          $update['photo'] = $this->imageCopy($this->input->post('photo',true));
          $update['is_active'] = $this->input->post('is_active');
          $update['modified'] = date('Y-m-d H:i:s');

          $this->model->get_update("auth_user",$update,["id_user"=>dec_url($id)]);

          $update_trans = array(
                                'id_group' => $this->input->post('id_group')
                              );

          $this->model->get_update("auth_user_to_group",$update_trans,["id_user"=>dec_url($id)]);
          set_message("success",cclang("notif_update"));
          $json['redirect'] = url("user");
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


function view($id = null)
{
  $this->is_allowed('user_detail');
  if ($row = $this->model->get_where_data(dec_url($id))) {
    $this->template->set_title(cclang("detail")." User");
    $data = array('nama' => set_value("nama",$row->name),
                  'email' => set_value("email",$row->email),
                  'is_active' => set_value("is_active",$row->is_active),
                  'group' => set_value("id_group",$row->group),
                  'photo' => set_value("photo",$row->photo),
                  'last_login' => set_value("last_login",$row->last_login),
                  'created' => set_value("created",$row->created),
                  );
    $this->template->view("content/user/view",$data);
  }else {
    $this->error404();
  }
}

function delete($id)
{
  if ($this->input->is_ajax_request()) {
    if (!is_allowed('user_delete')) {
      return $this->response([
        'type_msg' => "error",
        'msg' => "do not have permission to access"
      ]);
    }

    if (dec_url($id) == 1) {
      $json['type_msg'] = "error";
      $json['msg'] = cclang("notif_delete_failed");
    }else {
      $this->model->get_update("auth_user",["is_delete" => "1"],["id_user" => dec_url($id)]);
      $json['type_msg'] = "success";
      $json['msg'] = cclang("notif_delete");
    }

    return $this->response($json);
  }
}


function _cek_email($str)
{
  if (isset($_POST['last_email'])) {
    $qry = $this->db->get_where("auth_user",["email" => $str ,"email !=" => $_POST['last_email'] , "is_delete !=" => "1"]);
  }else {
    $qry = $this->db->get_where("auth_user",["email"=> $str , "is_delete !=" => "1"]);
  }
  if ($qry->num_rows() > 0) {
    $this->form_validation->set_message('_cek_email', '*&nbsp;already available');
    return FALSE;
  }else {
    return TRUE;
  }
}


}

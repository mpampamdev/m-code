<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* dev : mpampam*/
/* fb : https://facebook.com/mpampam*/
/* fanspage : https://web.facebook.com/programmerjalanan*/
/* web : www.mpampam.com*/
/* Generate By M-CRUD Generator 10/11/2020 14:51*/
/* Please DO NOT modify this information */


class Main_menu extends Backend{

  public function __construct()
  {
    parent::__construct();
    $this->load->model("main_menu_model","model");
  }

  function index()
  {
    $this->is_allowed('menu_list');
    $this->template->set_title("management menu");
    $this->template->view("content/main_menu/index");
  }

function save()
{
   if ($this->input->is_ajax_request()) {
     if (!$this->is_allowed('menu_drag_positions',false)) {
       return $this->response([
         'type_msg' => "error",
         'msg' => "Do not have permission to access"
       ]);
     }

     $data = json_decode($_POST['data']);
     $readbleArray = $this->parseJsonArray($data);

       $i=0;
       foreach($readbleArray as $row){
         $i++;
         $this->db->query("update main_menu set is_parent = '".$row['parentID']."', sort = '".$i."' where id_menu = '".$row['id']."' ");
       }

       $json['type_msg'] = 'success';
       $json['msg'] = 'Changed positions successfully';
       return $this->response($json);
   }
 }



 private function parseJsonArray($jsonArray, $parentID = 0)
 {
   $return = array();
   foreach ($jsonArray as $subArray) {
       $returnSubSubArray = array();
       if (isset($subArray->children)) {
       $returnSubSubArray = $this->parseJsonArray($subArray->children, $subArray->id);
     }

     $return[] = array('id' => $subArray->id, 'parentID' => $parentID);
     $return = array_merge($return, $returnSubSubArray);
   }
     return $return;
}

function _rules()
 {

   $rule = $_POST['type'] == "url" ? "|valid_url":"";
   $this->form_validation->set_rules("menu","&nbsp;*&nbsp;","trim|xss_clean|htmlspecialchars|required");
   $this->form_validation->set_rules("is_parent","&nbsp;*&nbsp;","trim|xss_clean|numeric|required");
   $this->form_validation->set_rules("is_active","&nbsp;*&nbsp;","trim|xss_clean|numeric|required");
   $this->form_validation->set_rules("type","&nbsp;*&nbsp;","trim|xss_clean|required");
   $this->form_validation->set_rules("data_target","&nbsp;*&nbsp;","trim|htmlspecialchars|xss_clean");
   $this->form_validation->set_rules('controller', '&nbsp;*&nbsp;', "trim|htmlspecialchars|xss_clean$rule");
   $this->form_validation->set_rules('icon', '&nbsp;*&nbsp;', 'trim|htmlspecialchars|xss_clean');
   $this->form_validation->set_error_delimiters('<span class="error text-danger" style="font-size:11px">','</span>');
 }

function add()
{
  $this->is_allowed('menu_add');
  $this->template->set_title(cclang("add")." menu");
  $data = array('action' => url("main_menu/add_action"),
                'button' => "save",
                'id_menu' => set_value("id_menu"),
                'menu' => set_value("menu"),
                'icon' => set_value("icon"),
                'data_target' => set_value("data_target"),
                'type' => set_value("type"),
                'controller' => set_value("controller"),
                'is_parent' => set_value("is_parent"),
                'is_active' => set_value("is_active")
                );
  $this->template->view("content/main_menu/form",$data);
}


function add_action()
{
  if ($this->input->is_ajax_request()) {
    if (!is_allowed('menu_add')) {
      show_error("Access Permission", 403,'403::Access Not Permission');
      exit();
    }

        $json = array('success'=>false, 'alert'=>array());
        $this->_rules();
        if ($this->form_validation->run()) {
          $insert = array('menu' => strtolower($this->input->post('menu',true)),
                          'slug' => url_title($this->input->post('menu',true),"-",true),
                          'is_parent' => $this->input->post('is_parent',true),
                          'is_active' => $this->input->post('is_active',true),
                          'target' => $this->input->post('data_target',true),
                          'type' => $this->input->post('type',true),
                          'controller' => strtolower($this->input->post('controller',true)),
                          'icon' => $this->input->post('icon',true),
                          'sort' => 0,
                          'created' => date('Y-m-d H:i:s'),
                        );

          $this->model->get_insert("main_menu",$insert);

          set_message("success",cclang("notif_save"));
          $json['redirect'] = url("main_menu");
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
  $this->is_allowed('menu_update');
  if ($row =  $this->model->get_where("main_menu",["id_menu"=>dec_url($id)])) {
    $this->template->set_title(cclang("update")." menu");
    $data = array('action' => url("main_menu/update_action/$id"),
                  'button' => "update",
                  'id_menu' => set_value("id_menu",dec_url($id)),
                  'menu' => set_value("menu",$row->menu),
                  'icon' => set_value("icon",$row->icon),
                  'data_target' => set_value("data_target",$row->target),
                  'type' => set_value("type",$row->type),
                  'controller' => set_value("controller",$row->controller),
                  'is_parent' => set_value("is_parent",$row->is_parent),
                  'is_active' => set_value("is_active",$row->is_active)
                  );
    $this->template->view("content/main_menu/form",$data);
  }else {
    $this->error404();
  }
}


function update_action($id)
{
  if ($this->input->is_ajax_request()) {
    if (!is_allowed('menu_update')) {
      show_error("Access Permission", 403,'403::Access Not Permission');
      exit();
    }

        $json = array('success'=>false, 'alert'=>array());
        $this->_rules();
        if ($this->form_validation->run()) {

          if ($this->input->post('is_parent',true)!="0") {
            $cek_child = $this->db->get_where("main_menu",["is_parent"=>dec_url($id)]);
            if ($cek_child->num_rows() > 0) {
                foreach ($cek_child->result() as $row_child) {
                  $update_child = array('is_parent' => "0");
                  $this->model->get_update("main_menu",$update_child, ["id_menu"=>$row_child->id_menu]);
                }
            }
          }

          $update = array('menu' => strtolower($this->input->post('menu',true)),
                          'slug' => url_title($this->input->post('menu',true),"-",true),
                          'is_parent' => $this->input->post('is_parent',true),
                          'is_active' => $this->input->post('is_active',true),
                          'target' => $this->input->post('data_target',true),
                          'type' => $this->input->post('type',true),
                          'controller' => strtolower($this->input->post('controller',true)),
                          'icon' => $this->input->post('icon',true),
                          'modified' => date('Y-m-d H:i:s'),
                        );

          $this->model->get_update("main_menu",$update, ["id_menu"=>dec_url($id)]);
          set_message("success",cclang("notif_update"));
          $json['redirect'] = url("main_menu");
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


function delete($id)
{
    if (!is_allowed('menu_delete')) {
      set_message("error","do not have permission to access");
    }else {
      $cek_child = $this->db->get_where("main_menu",["is_parent"=>dec_url($id)]);
      if ($cek_child->num_rows() > 0) {
          foreach ($cek_child->result() as $row_child) {
            $update_child = array('is_parent' => "0");
            $this->model->get_update("main_menu",$update_child, ["id_menu"=>$row_child->id_menu]);
          }
      }

    $this->db->delete("main_menu",["id_menu" => dec_url($id)]);
    set_message("success",cclang("notif_delete"));
    }

    redirect("backend/main_menu");
}


}

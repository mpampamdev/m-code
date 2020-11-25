<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* dev : mpampam*/
/* fb : https://facebook.com/mpampam*/
/* fanspage : https://web.facebook.com/programmerjalanan*/
/* web : www.mpampam.com*/
/* Generate By M-CRUD Generator 10/11/2020 14:51*/
/* Please DO NOT modify this information */


class Permission extends Backend{

  public function __construct()
  {
    parent::__construct();
    $this->load->model("Permission_model","model");
  }

  function _rules()
  {
    $this->form_validation->set_rules("permission","*&nbsp;","trim|xss_clean|htmlspecialchars|required|alpha_underscores|callback__cek_perms");
    $this->form_validation->set_rules("definition","*&nbsp;","trim|xss_clean|htmlspecialchars");
    $this->form_validation->set_error_delimiters('<i class="error text-danger" style="font-size:11px">','</i>');
  }

  function index()
  {
    $this->is_allowed('permission_list');
    $this->template->set_title("permission");
    $this->template->view("content/permission/index");
  }

  function json()
  {
    if ($this->input->is_ajax_request()) {
      if (!$this->is_allowed('permission_list',false)) {
        return $this->response([
				'is_allowed' => 'sorry you do not have permission to access'
				]);
      }

      $list = $this->model->get_datatables();
      $data = array();
      // $no = $_POST['start'];
      foreach ($list as $rows) {
          $row = array();
          $row[] = '<div class="form-check">
                      <label class="form-check-label">
                        <input type="checkbox" name="id" value="'.enc_url($rows->id).'" class="form-check-input select-delete">
                      <i class="input-helper"></i></label>
                    </div>';
          $row[] = $rows->id;
          $row[] = '<span class="text-primary">'.$rows->permission.'</span>';
          $row[] = '<span class="text-primary">'.ucwords(str_replace("_"," ",$rows->permission)).'</span>';
          $row[] = $rows->definition;

          $row[] = '
                      <div class="btn-group" role="group" aria-label="Basic example">
                          <a href="'.url("permission/update/".enc_url($rows->id)).'" id="update" class="btn btn-warning" title="'.cclang("update").'">
                            <i class="ti-pencil"></i>
                          </a>
                          <a href="'.url("permission/delete/".enc_url($rows->id)).'" id="delete" class="btn btn-danger" title="'.cclang("delete").'">
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


  function add()
  {
    $this->is_allowed('permission_add');
    $this->template->set_title(cclang("add")." Permission");
    $data = array('action' => url("permission/add_action"),
                  'button' => "save",
                  'permission' => set_value("permission"),
                  'definition' => set_value("definition")
                  );
    $this->template->view("content/permission/form",$data);
  }


  function add_action()
  {
    if ($this->input->is_ajax_request()) {
      if (!is_allowed('permission_add')) {
        show_error("Access Permission", 403,'403::Access Not Permission');
        exit();
      }

      $json = array('success' => false);
      $this->_rules();

      if ($this->form_validation->run()) {
        $save_data = ["permission"      =>  str_replace("-","_",strtolower($this->input->post("permission", true))),
                       "definition" => $this->input->post("definition", true)
                      ];

        $this->model->insert($save_data);

        set_message("success",cclang("notif_save"));

        $json['redirect'] = url("permission");
        $json['success'] = true;
      }else {
        foreach ($_POST as $key => $value) {
          $json['alert'][$key] = form_error($key);
        }
      }

      return $this->response($json);
    }
  }


  function update($id = null)
  {
    $this->is_allowed('permission_update');
    if ($row = $this->model->find(dec_url($id))) {
      $this->template->set_title(cclang("update")." Permission");
      $data = array('action' => url("permission/update_action/$id"),
                    'button' => "update",
                    'permission' => set_value("permission", $row->permission),
                    'definition' => set_value("definition", $row->definition)
                    );
      $this->template->view("content/permission/form",$data);
    }else {
      $this->error404();
    }
  }


  function update_action($id = null)
  {
    if ($this->input->is_ajax_request()) {
      if (!is_allowed('permission_update')) {
        show_error("Access Permission", 403,'403::Access Not Permission');
        exit();
      }

      $json = array('success' => false);
      $this->_rules();

      if ($this->form_validation->run()) {
        $save_data = [ "permission"      => str_replace("-","_",strtolower($this->input->post("permission", true))),
                       "definition" => $this->input->post("definition", true)
                      ];

        $this->model->change(dec_url($id), $save_data);

        set_message("success",cclang("notif_update"));

        $json['redirect'] = url("permission");
        $json['success'] = true;
      }else {
        foreach ($_POST as $key => $value) {
          $json['alert'][$key] = form_error($key);
        }
      }

      return $this->response($json);
    }
  }

  function delete($id = null)
  {
    if ($this->input->is_ajax_request()) {
        $json = array('type' =>"error" , "msg" => "error delete");
        if (!$this->is_allowed('permission_delete',false)) {
          return $this->response([
            'type_msg' => "error",
            'msg' => "Do not have permission to access"
  				]);
        }

        if ($id!=null) {
          $remove = $this->model->remove(dec_url($id));
          if ($remove) {
            $json['type_msg'] = "success";
            $json['msg'] = cclang("notif_delete");
          }else {
            $json['type_msg'] = "error";
            $json['msg'] = cclang("notif_delete_failed");
          }
        }

        if ($this->input->post('id')) {
          $id = $this->input->post('id');
          $exp = explode(",", $id);
          for ($i=0; $i <count($exp) ; $i++) {
            $remove = $this->model->remove(dec_url($exp[$i]));
          }

          $json['type_msg'] = "success";
          $json['msg'] = cclang("notif_delete");

        }


        return $this->response($json);
    }
  }

  function _cek_perms($str)
  {
      $str_replace = str_replace("-","_",$str);
      $data = strtolower($str_replace);
      if (isset($_POST['last_permission'])) {
        $qry = $this->model->get_data("auth_permission",["permission" => $str ,"permission !=" => $_POST['last_permission']]);
      }else {
        $qry = $this->model->get_data("auth_permission",["permission"=> $data]);
      }
    if ($qry->num_rows() > 0) {
      $this->form_validation->set_message('_cek_perms', '*&nbsp;'.cclang("already_available"));
      return FALSE;
    }else {
      return TRUE;
    }
  }





}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* dev : mpampam*/
/* fb : https://facebook.com/mpampam*/
/* fanspage : https://web.facebook.com/programmerjalanan*/
/* web : www.mpampam.com*/
/* Generate By M-CRUD Generator 10/11/2020 14:51*/
/* Please DO NOT modify this information */


class Group extends Backend{

  private $title = "Group";

  public function __construct()
  {
    $config = array(
      'title' => $this->title,
     );
    parent::__construct($config);
    $this->load->model("Group_model","model");
  }

  function _rules()
  {
    $this->form_validation->set_rules("group","*&nbsp;","trim|xss_clean|htmlspecialchars|required|alpha");
    $this->form_validation->set_rules("definition","*&nbsp;","trim|xss_clean|htmlspecialchars");
    $this->form_validation->set_error_delimiters('<i class="error text-danger" style="font-size:11px">','</i>');
  }

  function index()
  {
    $this->is_allowed('groups_list');
    $this->template->set_title("Group");
    $this->template->view("content/group/index");
  }

  function json()
  {
    if ($this->input->is_ajax_request()) {
      if (!is_allowed('groups_list')) {
        show_error("Access Permission", 403,'403::Access Not Permission');
        exit();
      }

      $list = $this->model->get_datatables();
      $data = array();
      // $no = $_POST['start'];
      foreach ($list as $rows) {
          $row = array();
          $row[] = '<span class="text-primary">'.ucfirst($rows->group.'</span>');
          $row[] = $rows->definition;


          $row[] = '
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="'.url("group/access_control/".enc_url($rows->id)).'" id="detail" class="btn btn-primary" title="'.cclang("access_control").'">
                          <i class="mdi mdi-checkbox-multiple-marked"></i> '.cclang("access_control").'
                        </a>
                        <a href="'.url("group/update/".enc_url($rows->id)).'" id="update" class="btn btn-warning" title="'.cclang("update").'">
                          <i class="ti-pencil"></i>
                        </a>
                        <a href="'.url("group/delete/".enc_url($rows->id)).'" id="delete" class="btn btn-danger" title="'.cclang("delete").'">
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
    $this->is_allowed('groups_add');
    $this->template->set_title("Add New Group");
    $data = array('action' => url("Group/add_action"),
                  'button' => "save",
                  'group' => set_value("group"),
                  'definition' => set_value("definition")
                  );
    $this->template->view("content/group/form",$data);
  }


  function add_action()
  {
    if ($this->input->is_ajax_request()) {
      if (!is_allowed('groups_add')) {
        show_error("Access Permission", 403,'403::Access Not Permission');
        exit();
      }

      $json = array('success' => false);
      $this->_rules();

      if ($this->form_validation->run()) {
        $save_data = ["group"      =>  strtolower($this->input->post("group", true)),
                       "definition" => $this->input->post("definition", true)
                      ];

        $this->model->insert($save_data);

        set_message("success",cclang("notif_save"));

        $json['redirect'] = url("group");
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
    $this->is_allowed('groups_update');
    if ($row = $this->model->find(dec_url($id))) {
      $this->template->set_title("Update Group");
      $data = array('action' => url("group/update_action/$id"),
                    'button' => "update",
                    'group' => set_value("group", $row->group),
                    'definition' => set_value("definition", $row->definition)
                    );
      $this->template->view("content/group/form",$data);
    }else {
      $this->error404();
    }
  }


  function update_action($id = null)
  {
    if ($this->input->is_ajax_request()) {
      if (!is_allowed('groups_update')) {
        show_error("Access Permission", 403,'403::Access Not Permission');
        exit();
      }

      $json = array('success' => false);
      $this->_rules();

      if ($this->form_validation->run()) {
        $save_data = [ "group"      => strtolower($this->input->post("group", true)),
                       "definition" => $this->input->post("definition", true)
                      ];

        $save = $this->model->change(dec_url($id), $save_data);

        if ($save) {
          set_message("success",cclang("notif_update"));
        }else {
          set_message("error",cclang("notif_update_failed"));
        }

        $json['redirect'] = url("group");
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

        if (!is_allowed('groups_delete')) {
          return $this->response([
            'type_msg' => "error",
            'msg' => "Do not have permission to access"
  				]);
        }

        $remove = $this->model->remove(dec_url($id));
        if ($remove) {
          $this->model->remove_table_where("auth_permission_to_group",["group_id" => dec_url($id)]);
          $json['type_msg'] = "success";
          $json['msg'] = cclang("notif_delete");
        }else {
          $json['type_msg'] = "error";
          $json['msg'] = cclang("notif_delete_failed");
        }
        return $this->response($json);
    }
  }


  function access_control($id = "")
  {
    $this->is_allowed('groups_access');
    if ($row = $this->model->find(dec_url($id))) {
      $this->template->set_title("Group ".cclang("access_control"));
      $data = array('action' => url("Group/save_acces_control/$id"),
                    'group' => set_value("group", $row->group),
                    'definition' => set_value("definition", $row->definition),
                    'list' => $this->model->list_control_access(dec_url($id))
                    );
      $this->template->view("content/group/access",$data);
    }else {
      $this->error404();
    }
  }

  function save_acces_control($id = "")
  {
    if (!is_allowed('groups_access')) {
      show_error("Access Permission", 403,'403::Access Not Permission');
      exit();
    }else {
      if ($this->model->find(dec_url($id))) {
          $permission = $this->input->post("id");
          $this->db->delete('auth_permission_to_group', ['group_id' => dec_url($id)]);

          if (count($permission)) {
        			$data = [];
        			foreach ($permission as $perms) {
        				$data[] = [
        					'permission_id' => $perms,
        					'group_id' => dec_url($id),
        				];
        			}
        			$save_access = $this->db->insert_batch('auth_permission_to_group', $data);
        		}

            set_message("success",cclang("notif_save"));
        }else {
            set_message("error",cclang("notif_save_failed"));
        }
    }
    redirect(url("group"));
  }


  function deletepermission($id = null)
  {
    if ($this->input->is_ajax_request()) {

        if (!is_allowed('permission_delete')) {
          return $this->response([
            'type_msg' => "error",
            'msg' => "Do not have permission to access"
  				]);
        }

        $this->db->where("id", dec_url($id));
        $remove = $this->db->delete("auth_permission");
        if ($remove) {
          set_message("success",cclang("notif_delete"));
        }else {
          set_message("error",cclang("notif_delete_failed"));
        }
        $json['success'] = true;
        return $this->response($json);
    }
  }

}

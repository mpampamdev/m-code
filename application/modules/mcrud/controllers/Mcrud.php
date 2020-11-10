<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mcrud extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->library(array("parser","mcrud/generate","form_validation"));
    $this->load->helper(array("file","generate","language","backend/app"));
    $this->lang->load("app",$this->config->item("language"));
  }

  function index()
  {
    $rm = array("setting","main_menu","ci_user_login","ci_user_log","ci_sessions","auth_user","auth_user_to_group","auth_permission","auth_permission_to_group","auth_group","main_menu","filemanager");
    $table = $this->db->list_tables();
    $get_table = array_diff($table, $rm);
    $data = array('table_name' => $get_table);
    $this->load->view("index",$data);

    // echo json_encode($get_table);
  }

  function get()
  {
    if ($this->input->is_ajax_request()) {
        $json = array('success'=>false, 'alert'=>array(), 'content'=>"");
        $tables_name = $this->input->post("values");
        if (!empty($tables_name)) {
          if (in_array($tables_name,$this->db->list_tables())) {
            // code...
            $data['table']    = $tables_name;
            $data['field']   = $this->db->field_data($tables_name);
            $json['content']  = $this->load->view("form_generate",$data,true);
            $json["success"]  = true;
          }else {
            $json["alert"] = "** Silahkan pilih table";
          }
        }else {
          $json["alert"] = "** Silahkan pilih table";
        }
        echo json_encode($json);
    }
  }


  function action()
  {
    $json = array('success' => false, 'msg' => array());
    $this->form_validation->set_rules("table","Table","trim|xss_clean|required");
    $this->form_validation->set_rules("title","Title","trim|xss_clean|required");
    $this->form_validation->set_rules("model","Model","trim|xss_clean|required|alpha_underscores|callback__cek_model");
    $this->form_validation->set_rules("controller","Controller","trim|xss_clean|alpha_underscores|required|callback__cek_controller");
    $this->form_validation->set_rules("show_table[]","Show on table","trim|xss_clean|required",[
      "required" => "(".cclang('show_in_table').") ".cclang("select_one_field")
    ]);
    $this->form_validation->set_error_delimiters('<li class="error text-danger"><i style="font-size:11px">','</i></li>');

    if ($this->form_validation->run()) {
      //table
      $table = $this->input->post("table");
      $field = $this->db->field_data($table); //array
      $title = $this->input->post("title");

      //controllers
      $controller = strtolower($this->input->post("controller"));
      $controller_file_name = ucfirst($controller).".php";
      $controller_class = ucfirst($controller);
      $controller_title = strtolower($controller);
      //models
      $model = strtolower($this->input->post("model"));
      $model_file_name = ucfirst($model).".php";
      $model_class = ucfirst($model);
      //Directory
      $dir = strtolower($controller);
      //make a Directory
      if (!file_exists(FCPATH . '/application/modules/backend/views/content/' . $dir)) {
        mkdir(FCPATH . '/application/modules/backend/views/content/' . $dir, 0777, TRUE);
      }


      $config = [ "tag_php_open" => "<?php",
                  "open" => "<?=",
                  "close" => "?>",
                  "table" => $table,
                  "primary_key" => $this->generate->primary_key(),
                  "date" => date("d/m/Y H:s"),
                  "title_module" => $title,
                  "dir" => $dir,
                  "controller_title" => $controller_title,
                  "controller_class" => $controller_class,
                  "content_rules" => $this->generate->content_rules(),
                  "content_json" => $this->generate->content_json(),
                  "add" => $this->generate->params("add"),
                  "update" => $this->generate->params("update"),
                  "detail" => $this->generate->params("detail"),
                  "input_post" => $this->generate->input_post(),
                  "model_class" => $model_class,
                  "model_select" => $this->generate->content_model_get_field("select"),
                  "model_column_order" => $this->generate->content_model_get_field("order"),
                  "model_filter" => $this->generate->content_model_get_field("filter"),
                  "index_thead" => $this->generate->content_index('thead'),
                  "index_coulumn_defs" => $this->generate->content_index('column_defs'),
                  "content_filter" => $this->generate->content_filter('form_filter'),
                  "data_filter" => $this->generate->content_filter('data_filter'),
                  "delete_filter" => $this->generate->content_filter('filter_delete'),
                  "content_form" => $this->generate->content_form(),
                  "content_detail" => $this->generate->params("detail_view"),
                  ];
      //make controller
      $create_controller = $this->parser->parse('mcrud/core/temp_controllers.tmp', $config, TRUE);
      write_file(FCPATH . "/application/modules/backend/controllers/$controller_file_name", $create_controller);

      //make models
      $create_model = $this->parser->parse('mcrud/core/temp_models.tmp', $config, TRUE);
      write_file(FCPATH . "/application/modules/backend/models/$model_file_name", $create_model);

      //make index
      $create_index = $this->parser->parse('mcrud/core/temp_index.tmp', $config, TRUE);
      write_file(FCPATH . "/application/modules/backend/views/content/$dir/index.php", $create_index);

      //make filter
      $create_filter = $this->parser->parse('mcrud/core/temp_filter.tmp', $config, TRUE);
      write_file(FCPATH . "/application/modules/backend/views/content/$dir/filter.php", $create_filter);

      //make form
      $create_form = $this->parser->parse('mcrud/core/temp_form.tmp', $config, TRUE);
      write_file(FCPATH . "/application/modules/backend/views/content/$dir/form.php", $create_form);

      //make detail
      $create_detail = $this->parser->parse('mcrud/core/temp_detail.tmp', $config, TRUE);
      write_file(FCPATH . "/application/modules/backend/views/content/$dir/detail.php", $create_detail);

      $location = [
        "/application/modules/backend/controllers/$controller_file_name",
        "/application/modules/backend/models/$model_file_name",
        "/application/modules/backend/views/content/$dir/index.php",
        "/application/modules/backend/views/content/$dir/filter.php",
        "/application/modules/backend/views/content/$dir/form.php",
        "/application/modules/backend/views/content/$dir/detail.php"
      ];

      $json['msg'] = $location;
      $json['success'] = true;
    }else {
        $json['msg'] = validation_errors();
    }
    echo json_encode($json);

  }

  function _cek_model($str)
  {
    if (file_exists(FCPATH . '/application/modules/backend/models/' . $str.".php")) {
      $this->form_validation->set_message('_cek_model', '%s '.cclang("already_available"));
      return FALSE;
    }else {
      if ($str == $_POST['controller']) {
        $this->form_validation->set_message('_cek_model', cclang("cek_models"));
        return FALSE;
      }else {
        return true;
      }
    }
  }

  function _cek_controller($str)
  {
    if (file_exists(FCPATH . '/application/modules/backend/controllers/' . $str.".php")) {
      $this->form_validation->set_message('_cek_controller', '%s '.cclang("already_available"));
      return FALSE;
    }else {
        return true;
    }
  }


}

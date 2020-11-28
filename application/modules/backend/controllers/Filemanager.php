<?php defined('BASEPATH') OR exit('No direct script access allowed');

/* dev : mpampam*/
/* fb : https://facebook.com/mpampam*/
/* fanspage : https://web.facebook.com/programmerjalanan*/
/* web : www.mpampam.com*/
/* Generate By M-CRUD Generator 08/11/2020 00:31*/
/* Location: ./application/modules/backend/controllers/Filemanager.php*/
/* Please DO NOT modify this information */


class Filemanager extends Backend{

  private $title = "File manager";

  public function __construct()
  {
    $config = array(
      'title' => $this->title,
		 );
		parent::__construct($config);
    $this->load->model("Filemanager_model","model");
  }

  function _rules()
  {
		$this->form_validation->set_rules('file_name', 'File Name', 'trim|xss_clean|htmlspecialchars|required');
		$this->form_validation->set_error_delimiters('<i class="text-danger" style="font-size:11px">', '</i>');
  }

  function index()
  {
    $this->is_allowed('filemanager_list');
    $this->template->set_title("$this->title");
    $this->template->view("content/filemanager/index");
  }

  function json()
  {
    if ($this->input->is_ajax_request()) {
    if (!$this->is_allowed('filemanager_list',false)) {
      return $this->response([
      'is_allowed' => 'sorry you do not have permission to access'
      ]);
    }
      $rows = $this->model->get_datatables();
      $data = array();
      foreach ($rows as $get) {
          $row = array();
          $row[] = '<div class="form-check">
                      <label class="form-check-label">
                        <input type="checkbox" name="id" value="'.enc_url($get->id).'" class="form-check-input">
                      <i class="input-helper"></i></label>
                    </div>';
          $row[] = imgView($get->file_name);
					$row[] = "<span class='text-primary'>$get->file_name</span>";
          $row[] = $get->ket;
          $row[] = date('d/m/Y H:i', strtotime($get->created));
          $row[] = '
                      <div class="btn-group" role="group" aria-label="Basic example">
                          <button type="button" data-text="'.base_url("_temp/uploads/img/$get->file_name").'" class="btn btn-warning" id="copyboard"  title="copy path img">
                            <i class="ti-files"></i>
                          </button>
                        </div>

                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" data-text="'.$get->file_name.'" class="btn btn-warning" id="copyboard"  title="copy name img">
                              <i class="mdi mdi-checkbox-multiple-blank-outline"></i>
                            </button>
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


  function filter()
  {
    $this->template->view("content/filemanager/filter",[],false);
  }



  function add()
  {
    $this->is_allowed('filemanager_add');
    $this->template->set_title(cclang("add")." $this->title");
    $data = array('action' => url("filemanager/add_action"),
                  'params' => "add",
									'file_name' => set_value('file_name')
                  );
    $this->template->view("content/filemanager/form",$data);
  }


  function add_action()
  {
    if($this->input->is_ajax_request()){
      if (!is_allowed('filemanager_add')) {
        show_error("Access Permission", 403,'403::Access Not Permission');
        exit();
      }

      $json = array('success' => false, "alert" => array());
      $this->_rules();
      if ($this->form_validation->run()) {
				$save_data['file_name'] = $this->imageCopy($this->input->post('file_name',true),$_POST['file-dir']);
        $save_data['ket'] = $this->input->post('ket',true);
				$save_data['created'] = date('Y-m-d H:i:s');

        $this->model->insert($save_data);
        set_message("success",cclang("notif_save"));

        $json['redirect'] = url("filemanager");
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
        if (!is_allowed('filemanager_delete')) {
          return $this->response([
            'type_msg' => "error",
            'msg' => "Do not have permission to access"
  				]);
        }


        if ($id!=null) {
          $getimg = $this->model->find(dec_url($id));
          $this->imageRemove($getimg->file_name, false);
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
            $getimg = $this->model->find(dec_url($exp[$i]));
            $this->imageRemove($getimg->file_name, false);
            $this->model->remove(dec_url($exp[$i]));
          }

          $json['type_msg'] = "success";
          $json['msg'] = cclang("notif_delete");

        }

        return $this->response($json);
    }
  }


}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* dev : mpampam*/
/* fb : https://facebook.com/mpampam*/
/* fanspage : https://web.facebook.com/programmerjalanan*/
/* web : www.mpampam.com*/
/* Generate By M-CRUD Generator 10/11/2020 14:51*/
/* Please DO NOT modify this information */


class Setting extends Backend{

  public function __construct()
  {
    parent::__construct();
    $this->load->model("Setting_model","model");
  }

  function index()
  {
    $this->template->set_title(cclang("setting"));
    $data['time_zone'] = $this->time_zone();
    $this->template->view("content/setting/index",$data);
  }

  function update_action()
  {
    if ($this->input->is_ajax_request()) {
      $enc_url = $this->config->item("encryption_url") ? "TRUE":"FALSE";
      $config = array('php_tag_open' 	=> '<?php',
                      'time_zone' => $this->config->item("time_zone"),
                      'language' => $this->config->item("language"),
                      'encryption_key' => $this->config->item("encryption_key"),
                      'encryption_url' => $enc_url,
                      'url_suffix' => $this->config->item("url_suffix")
                      );

      $pk = $this->input->post("pk", true);
      $name = $this->input->post("name", true);
      $value = htmlspecialchars($this->input->post("value", true));

      $json = array('success'=>false, 'msg'=>array());
      if (!is_allowed("config_update_".strtolower($name))) {
        return $this->response([
          'success' => false,
          'msg' => "Do not have permission to update"
        ]);
      }

      if ($pk == "4") {
        $this->form_validation->set_rules("value","* ","trim|xss_clean|required|valid_email");
      }else {
        $this->form_validation->set_rules("value","* ","trim|xss_clean|required");
      }
      $this->form_validation->set_error_delimiters('','');

      if ($this->form_validation->run()) {

        if ($pk == "999") {
          $this->load->library("parser");
          $this->load->helper("file");
          $config[$name] = $value;
          $config_template = $this->parser->parse('content/core/config_template.txt', $config, TRUE);
			    write_file(FCPATH . '/application/config/config.php', $config_template);
        }else {
          $update = array("value" => $value);
          $this->model->get_update("setting", $update ,["id_setting"=>$pk]);
        }

        $json['value'] = $value;
        $json['success'] = true;
      }else {
        $json['msg'] = form_error("value");
      }
      return $this->response($json);

    }
  }


  function file_upload()
  {
    if ($this->input->is_ajax_request()) {
      if (!is_allowed("config_update_logo")) {
        return $this->response([
          'success' => false,
          'alert' => "do not have permission to update"
        ]);
      }

        $config = [
    			'upload_path' 		=> './_temp/uploads/logo/',
    			'allowed_types' 	=> 'png|jpeg|jpg',
    			'max_size'  		=> '1000',
    		];

        $this->load->library('upload', $config);
        if ($this->upload->do_upload('qqfile')){
          $upload_data = $this->upload->data();

          if (file_exists("./_temp/uploads/logo/".setting("logo"))) {
            unlink("./_temp/uploads/logo/".setting("logo"));
          }

          $update = array('value'=>$upload_data['file_name']);

          $this->model->get_update("setting",$update,["options"=>"logo"]);

          $json['uploadName'] = $upload_data['file_name'];
          $json['alert'] = "Upload successfully";
          $json['success'] = true;
        }else {
          $json['alert'] = $this->upload->display_errors();
          $json['success'] = false;
        }
      }
    return $this->response($json);
  }

  function get_avatar()
  {
    $json[] = array('success' 		  => true,
          					'thumbnailUrl'  => base_url()."_temp/uploads/logo/".setting("logo"),
                    'id' 					  => 0,
          					'name' 					=> setting("logo"),
          					'uuid' 					=> setting("logo","id_setting"),
                  );
    return $this->response($json);
  }


  function time_zone()
{
	$timezones = [];
	foreach(timezone_abbreviations_list() as $abbr => $timezone){
					foreach($timezone as $val){
									if(isset($val['timezone_id'])){
												$timezones[$val['timezone_id']] = $val['timezone_id'];
									}
					}
	}

	 foreach ($timezones as $tmzid) {
		 $json[] = array("value" => $tmzid,
                      "text" => $tmzid
                    );
	}

  sort($json);
	return json_encode($json);
}



}

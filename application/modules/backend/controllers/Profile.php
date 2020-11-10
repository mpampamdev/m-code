<?php defined('BASEPATH') OR exit('No direct script access allowed');

/* dev : mpampam*/
/* fb : https://facebook.com/mpampam*/
/* fanspage : https://web.facebook.com/programmerjalanan*/
/* web : www.mpampam.com*/
/* Generate By M-CRUD Generator 10/11/2020 14:51*/
/* Location: ./application/modules/backend/controllers/Profile.php*/
/* Please DO NOT modify this information */


class Profile extends Backend{

  private $title = "Profile";

  public function __construct()
  {
    $config = array(
      'title' => $this->title,
     );
    parent::__construct($config);
    $this->load->model("Profile_model","model");
  }

  function _rules()
  {
		$this->form_validation->set_rules('nama', 'Nama', 'trim|xss_clean|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|xss_clean|required|valid_email');
		$this->form_validation->set_rules('telepon', 'Telepon', 'trim|xss_clean|required|numeric');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|xss_clean');
		$this->form_validation->set_rules('foto', 'Foto', 'trim|xss_clean');
		$this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|xss_clean|required');
		$this->form_validation->set_rules('tanggal_waktu', 'Tanggal Waktu', 'trim|xss_clean|required');
		$this->form_validation->set_error_delimiters('<i class="text-danger" style="font-size:11px">', '</i>');
  }

  function index()
  {
    $this->is_allowed('profile_list');
    $this->template->set_title("$this->title");
    $this->template->view("content/profile/index");
  }

  function json()
  {
    if ($this->input->is_ajax_request()) {
    if (!$this->is_allowed('profile_list',false)) {
      return $this->response([
      'is_allowed' => 'sorry you do not have permission to access'
      ]);
    }
      $rows = $this->model->get_datatables();
      $data = array();
      foreach ($rows as $get) {
          $row = array();
					$row[] = $get->nama;
					$row[] = $get->email;
					$row[] = $get->telepon;
					$row[] = $get->alamat;
					$row[] = $get->foto;
					$row[] = $get->tanggal;
					$row[] = $get->tanggal_waktu;
          $row[] = '
                      <div class="btn-group" role="group" aria-label="Basic example">
                          <a href="'.site_url("backend/profile/detail/".enc_url($get->id)).'" id="detail" class="btn btn-primary" title="'.cclang("detail").'">
                            <i class="ti-file"></i>
                          </a>
                          <a href="'.site_url("backend/profile/update/".enc_url($get->id)).'" id="update" class="btn btn-warning" title="'.cclang("upadte").'">
                            <i class="ti-pencil"></i>
                          </a>
                          <a href="'.site_url("backend/profile/delete/".enc_url($get->id)).'" id="delete" class="btn btn-danger" title="'.cclang("delete").'">
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


  function filter()
  {
    $this->template->view("content/profile/filter",[],false);
  }

  function detail($id = null)
  {
    $this->is_allowed('profile_detail');
    if ($row = $this->model->find(dec_url($id))) {
      $this->template->set_title(cclang("detail")." $this->title");
      $data = array(
										'nama' => set_value('nama',$row->nama),
										'email' => set_value('email',$row->email),
										'telepon' => set_value('telepon',$row->telepon),
										'alamat' => set_value('alamat',$row->alamat),
										'foto' => set_value('foto',$row->foto),
										'tanggal' => set_value('tanggal',date('Y-m-d',strtotime($row->tanggal))),
										'tanggal_waktu' => set_value('tanggal_waktu',dateTimeFormat($row->tanggal_waktu)),
                    );
      $this->template->view("content/profile/detail",$data);
    }
  }


  function add()
  {
    $this->is_allowed('profile_add');
    $this->template->set_title(cclang("add")." $this->title");
    $data = array('action' => site_url("backend/profile/add_action"),
                  'params' => "add",
									'nama' => set_value('nama'),
									'email' => set_value('email'),
									'telepon' => set_value('telepon'),
									'alamat' => set_value('alamat'),
									'foto' => set_value('foto'),
									'tanggal' => set_value('tanggal'),
									'tanggal_waktu' => set_value('tanggal_waktu'),
                  );
    $this->template->view("content/profile/form",$data);
  }


  function add_action()
  {
    if($this->input->is_ajax_request()){
      if (!$this->is_allowed('profile_add',false)) {
        return $this->response([
        'is_allowed' => 'Sorry you do not have permission to access'
        ]);
      }

      $json = array('success' => false, "alert" => array());
      $this->_rules();
      if ($this->form_validation->run()) {
				$save_data['nama'] = $this->input->post('nama',true);
				$save_data['email'] = $this->input->post('email',true);
				$save_data['telepon'] = $this->input->post('telepon',true);
				$save_data['alamat'] = $this->input->post('alamat',true);
				$save_data['foto'] = $this->imageCopy($this->input->post('foto',true));
				$save_data['tanggal'] = date('Y-m-d',strtotime($this->input->post('tanggal',true)));
				$save_data['tanggal_waktu'] = date('Y-m-d H:i',strtotime($this->input->post('tanggal_waktu',true)));

        $this->model->insert($save_data);
        set_message("success",cclang("notif_save"));

        $json['redirect'] = site_url("backend/profile");
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
    $this->is_allowed('profile_update');
    if ($row = $this->model->find(dec_url($id))) {
      $this->template->set_title(cclang("update")." $this->title");
      $data = array('action' => site_url("backend/profile/update_action/$id"),
                    'params' => "update",
										'nama' => set_value('nama',$row->nama),
										'email' => set_value('email',$row->email),
										'telepon' => set_value('telepon',$row->telepon),
										'alamat' => set_value('alamat',$row->alamat),
										'foto' => set_value('foto',$row->foto),
										'tanggal' => set_value('tanggal',date('Y-m-d',strtotime($row->tanggal))),
										'tanggal_waktu' => set_value('tanggal_waktu',dateTimeFormat($row->tanggal_waktu)),
                    );
      $this->template->view("content/profile/form",$data);
    }
  }

  function update_action($id = null)
  {
    if($this->input->is_ajax_request()){
      if (!$this->is_allowed('profile_update',false)) {
        return $this->response([
        'is_allowed' => 'sorry_you_do_not_have_permission_to_access'
        ]);
      }

      $json = array('success' => false, "alert" => array());
      $this->_rules();
      if ($this->form_validation->run()) {
				$save_data['nama'] = $this->input->post('nama',true);
				$save_data['email'] = $this->input->post('email',true);
				$save_data['telepon'] = $this->input->post('telepon',true);
				$save_data['alamat'] = $this->input->post('alamat',true);
				$save_data['foto'] = $this->imageCopy($this->input->post('foto',true));
				$save_data['tanggal'] = date('Y-m-d',strtotime($this->input->post('tanggal',true)));
				$save_data['tanggal_waktu'] = date('Y-m-d H:i',strtotime($this->input->post('tanggal_waktu',true)));

        $this->model->change(dec_url($id), $save_data);
        set_message("success",cclang("notif_update"));

        $json['redirect'] = site_url("backend/profile");
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

        if (!$this->is_allowed('profile_delete',false)) {
          return $this->response([
            'type_msg' => "error",
            'msg' => "Do not have permission to access"
  				]);
        }

        $remove = $this->model->remove(dec_url($id));
        if ($remove) {
          $json['type_msg'] = "success";
          $json['msg'] = cclang("notif_delete");
        }else {
          $json['type_msg'] = "error";
          $json['msg'] = cclang("notif_delete_failed");
        }
        return $this->response($json);
    }
  }


}

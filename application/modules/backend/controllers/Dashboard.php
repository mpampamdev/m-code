<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* dev : mpampam*/
/* fb : https://facebook.com/mpampam*/
/* fanspage : https://web.facebook.com/programmerjalanan*/
/* web : www.mpampam.com*/
/* Generate By M-CRUD Generator 10/11/2020 14:51*/
/* Please DO NOT modify this information */


class Dashboard extends Backend{

  public function __construct()
  {
    parent::__construct();
    $this->load->model("Core_model","model");
  }

  function index()
  {
    $this->template->set_title("Dashboard");
    $this->template->view("Content/dashboard/index");
  }

  function test()
  {
    // show_error("Access Permission", 403,'403::Access Not Permission');
    // echo CI_VERSION;
    echo randomKey();
  }


}

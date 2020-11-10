<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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


}

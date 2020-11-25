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
    $this->template->view("content/dashboard/index");
  }

  function test()
  {
    $this->load->library(array("Encryption","My_encrypt"));
    $msg = 15;

    $encrypted_string = enc_url($msg);
    echo $encrypted_string;
    echo "<br>";
    $decode_string = dec_url($encrypted_string);
    echo $decode_string;
    echo "<br>";


    echo ADMIN_ROUTE;


    // echo '<a href="'.get_url().'">dasads</a>';
  }


  function folderSize ($dir = null)
{
  $dir = "./_temp/uploads/img/";
    $size = 0;

    foreach (glob(rtrim($dir, '/').'/*', GLOB_NOSORT) as $each) {
        $size += is_file($each) ? filesize($each) : folderSize($each);
    }

    echo $size. "Kb";
}


}

<?php defined('BASEPATH') OR exit('No direct script access allowed');
if(!function_exists('is_allowed')) {
  function field_title($str)
  {
    $rpl = str_replace("_"," ",$str);
    return ucwords($rpl);
  }
}

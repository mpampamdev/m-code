<?php if (!defined("BASEPATH")) exit("No direct script access allowed");
if(!function_exists('enc_url')) {
  function enc_url($plainText) {
      $ci=&get_instance();
      if ($ci->config->item("encryption_url")) {
        $randomKey = randomKey(5);
        $base64 = base64_encode($randomKey.",".$plainText.",".$randomKey);
        $base64url = strtr($base64, '+/=', '-  ');
        return trim($base64url);
      }else {
        return $plainText;
      }
  }
}

if(!function_exists('dec_url')) {
  function dec_url($plainText) {
    $ci=&get_instance();
    if ($ci->config->item("encryption_url")) {
      $base64url = strtr($plainText, '-', '+/=');
      $base64 = base64_decode($base64url);
      $exp = explode(",",$base64);
      return $exp[1];
    }else {
      return $plainText;
    }
  }
}

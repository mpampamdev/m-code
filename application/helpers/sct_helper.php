<?php if (!defined("BASEPATH")) exit("No direct script access allowed");
if(!function_exists('enc_url')) {
  function randomKey($length = 32)
  {
    $ci=&get_instance();
    // $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    // $charactersLength = strlen($characters);
    // $randomString = '';
    // for ($i = 0; $i < $length; $i++) {
    //     $randomString .= $characters[rand(0, $charactersLength - 1)];
    // }
    // return $randomString;

    return bin2hex($ci->encryption->create_key(16));
  }
}

if(!function_exists('enc_url')) {
  function enc_url($plainText) {
      $ci=&get_instance();
      if ($ci->config->item("encryption_url")) {
        return $ci->my_encrypt->encode($plainText);
      }else {
        return $plainText;
      }
  }
}

if(!function_exists('dec_url')) {
  function dec_url($plainText) {
    $ci=&get_instance();
    if ($ci->config->item("encryption_url")) {
      return $ci->my_encrypt->decode($plainText);
    }else {
      return $plainText;
    }
  }
}


// if(!function_exists('enc_url')) {
//   function enc_url($plainText) {
//       $ci=&get_instance();
//       if ($ci->config->item("encryption_url")) {
//         $randomKey = randomKey(20);
//         $randomKeys = randomKey(20);
//         $base64 = base64_encode($randomKey.",".$plainText.",".$randomKeys.",".$plainText);
//         $base64url = strtr($base64, '+/=', '-  ');
//         return trim($base64url);
//       }else {
//         return $plainText;
//       }
//   }
// }
//
// if(!function_exists('dec_url')) {
//   function dec_url($plainText) {
//     $ci=&get_instance();
//     if ($ci->config->item("encryption_url")) {
//       $base64url = strtr($plainText, '-  ', '+/=');
//       $base64 = base64_decode($base64url);
//       $exp = explode(",",$base64);
//       if ($exp[1] != $exp[3]) {
//         return $plainText;
//       }else {
//         return $exp[1];
//       }
//     }else {
//       return $plainText;
//     }
//   }
// }

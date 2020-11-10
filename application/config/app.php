<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$json =  json_decode(file_get_contents('application/config/app.cfg'));

$config['author'] = $json->author;
$config['version'] = $json->version;

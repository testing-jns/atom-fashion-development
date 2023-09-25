<?php 

require_once "../app/vendor/autoload.php";
require_once "../app/config/initialize-config.php";
use \plugins\Mailler;
require_once(PATH_APP ."/views/mailer/template.php");


$verify_key = custom_random();
$url_verify = BASE_URL . "verify/" . $verify_key;
$email_response = Mailler::run("jhuanes23@gmail.com", $url_verify);

var_dump($email_response);

// echo(template($url_verify));

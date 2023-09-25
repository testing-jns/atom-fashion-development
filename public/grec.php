<?php

require_once "../app/vendor/autoload.php";
require_once "../app/config/initialize-config.php";

use \middlewares\GoogleRecaptcha;

// define("ENV", parse_ini_file(".env"));

if(isset($_POST['btn-submit'])) {
$google_response = $_POST["g-recaptcha-response"];
$remote_IP = $_SERVER["REMOTE_ADDR"];

$response = GoogleRecaptcha::run($google_response, $remote_IP);
var_dump($response->success);
die();

}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Google ReCaptcha</title>
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>

<body>
    <form method="post">
        <input type="text" name="nama" placeholder="name"></input><br />
        <button type="submit" name="btn-submit">SUBMIT</button><br />
        <div class="g-recaptcha" data-sitekey="6LdFGFQmAAAAALwYiveDWpyw_Z8vStTwiexbvLV9" data-callback="callback"></div>
    </form>
</html>
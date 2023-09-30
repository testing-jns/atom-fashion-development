<?php 

// header("Content-type: image/png");

require_once "../app/vendor/autoload.php";
require_once "../app/config/initialize-config.php";

use \core\Database;


$db = new Database();




// var_dump($response);
// var_dump($response->status());
// var_dump($response->result());
// echo $response->result()->image;

if (isset($_GET["q"])) {
    $product = $_GET["q"];
    $response = $db->query("SELECT distinct(id), image_path FROM thumbnails WHERE id = '$product'")->execute();
 
    $thumbnails = $response->resultAll(); 

    foreach ($thumbnails as $key => $value) {
        $base64 = base64_encode($value->image);
        echo "<img src='$base64'>";
    }
    
}


?>
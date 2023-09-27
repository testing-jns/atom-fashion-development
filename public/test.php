<?php 

require_once "../app/vendor/autoload.php";
require_once "../app/config/initialize-config.php";



use \middlewares\CookieManager;

// CookieManager::set("sampah000sampah@gmail.com", "customer");
$result = CookieManager::get();

var_dump($result);
var_dump($result["results"]["email"] ?? "gada");

// CookieManager::destroy();

// $result = CookieManager::verify();
// var_dump($result);






// use core\Database;

// $db = new Database();

// $sql = "SELECT `password` FROM customers WHERE email = 'sampah00sampah@gmail.com'";

// $response = $db->query($sql)->execute();
// var_dump($response);
// var_dump($response->status());
// $result = $response->result();
// var_dump(boolval($result));
// var_dump($result->password);
// if (!$result->password) {
//     var_dump("yayaya");
// }
// var_dump(empty($result->password));
// var_dump($response->resultAll());

die();

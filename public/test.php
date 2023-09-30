<?php 




require_once "../app/config/initialize-config.php";
require_once "../app/vendor/autoload.php";


use core\Database;

$db = new Database();

    $username = "atom";
    $sql = "SELECT `password` FROM admin WHERE username = :username";
    $bind_values = [
        ":username" => $username
    ];

    $response = $db->query($sql)->bindValue($bind_values)->execute();
    $result = $response->result();



var_dump($result->password);
$password = "anoynm-atomic-12345";
var_dump(password_verify($password, $result->password));














die();
require_once "../app/vendor/autoload.php";


// use core\Database;

$db = new Database();

// $sql = "SELECT first_name, last_name, picture FROM customers WHERE email = 'jhuanes23@gmail.com'";
// $sql = "SELECT count(category) as total, category FROM `products` group by category";
$sql = "SELECT code, `name`, category, price, discount, thumbnail_id FROM products WHERE discount > 0";
// $sql = "SELECT MAX(discount) FROM products";
$response = $db->query($sql)->execute();
$result = $response->resultAll();
var_dump($result);



// use \middlewares\CookieManager;

// // CookieManager::set("sampah000sampah@gmail.com", "customer");
// $result = CookieManager::get();

// var_dump($result);
// var_dump($result["results"]["email"] ?? "gada");

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

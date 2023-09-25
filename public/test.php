<?php 



// $res = file_get_contents("email.php");
// var_dump($res);


// die();



require_once "../app/vendor/autoload.php";
require_once "../app/config/initialize-config.php";

use \core\Database;


$db = new Database();

// $sql = "select password from customers where id = '38e4cb34881963e49d2ae8a3899d80d2'";
// $response = $db->query($sql)->execute()->result();


// var_dump($response->password);
// $2y$10$ILJbJTe6DSRQXxP8A2MlyONxGeDWc8TM4vaIk7C.LiazNUiuk4k2m
// var_dump(password_verify("jns123", '$2y$10$ILJbJTe6DSRQXxP8A2MlyONxGeDWc8TM4vaIk7C.LiazNUiuk4k2m'));
// var_dump(password_verify("jns123", $response->password));
// var_dump(password_hash("jns123", PASSWORD_DEFAULT));

// function custom_random_hehe(int $length = 32) {
//     if ($length % 2 === 0) return bin2hex(random_bytes($length / 2));
//     throw new Exception("Can't use odd numbers");
// }

$response = $db->query("delete from verify where customer_id = 'c35fc7e004614e73d25e29ff43623bd5'")->execute();
var_dump($response);

die();

$sql = "INSERT INTO verify (customer_id, `type`, `key`) VALUES (:customer_id, :type, :key)";
$bind_values = [
    ":customer_id" => "c35fc7e004614e73d25e29ff43623bd5",
    ":type" => "signup",
    ":key" => custom_random(30)
];

$response = $db->query($sql)->bindValue($bind_values)->execute();

var_dump($response);














die();


$sql = "INSERT INTO customers (id, first_name, last_name, email, password) VALUES (:id, :first_name, :last_name, :email, :password)";

$password_hashing = password_hash("jns123", PASSWORD_DEFAULT);

$temp = [
    ":id" => custom_random_hehe(),
    ":first_name" => "Jhuanes",
    ":last_name" => "Septinus",
    ":email" => "jhuanesjns23@gmail.com",
    ":password" => $password_hashing
];

$response = $db->query($sql)->bindValue($temp)->execute();
var_dump($response->rowCount());


die();



// require_once "../app/vendor/autoload.php";
// require_once "../app/config/initialize-config.php";;

// use \core\Database;


// $db = new Database();

// $response = $db->query("delete from products")->execute()->rowCount();
// $response = $db->query("select * from products")->rowCount();

// htmlspecialchars()
// trim()

// $responses = $db->execute();
// var_dump($response);

$temp = [
    ":code"         => "PROD_7Y57CN2XM2389O",
    ":name"         => "Pakaian Pria",
    ":category"     => "clothes",
    ":for_gender"   => "",
    ":price"        => "200000",
    ":discount"     => 0,
    ":max_purchase" => 50,
    ":stock"        => "200",
    ":sold"         => "10",
    ":description"  => "Ini adalah pakaian pria",
    ":tags"         => "pakaian, baju,pria",
    ":rating"       => "5",
    ":thumbnail_id" => "THUMB_74BVN77T4W"
];

// var_dump("sf" ?: "haiii");
// die();

// 


$sql = "insert into products (code, name, category, for_gender, price, discount, max_purchase, stock, sold, description, tags, rating, thumbnail_id) values (:code, :name, :category, :for_gender, :price, :discount, :max_purchase, :stock, :sold, :description, :tags, :rating, :thumbnail_id)";
// // $sql_get = "select * from siswa";
$response = $db->query($sql)->bindValue($temp)->execute();

var_dump($response);
var_dump($response->result());
var_dump($response->resultAll());
var_dump($response->rowCount());



// $db->query($sql)->bindValue($temp);
// $responses = $db->execute();














die();

// admin_id     32  ...
// customer_id  32  ...
// product_code 00  PROD_
// whislist_id  
// cart_id      
// thumbnail_id 


// function custom_random(int $length = 32) : string {
//     if ($length % 2 === 0) return bin2hex(random_bytes($length / 2));
//     throw new Exception("Can't use odd numbers");
// }



function _tvc_(int $length = 32) : string {
    return bin2hex(random_bytes($length / 2));
}


// var_dump(uniqid());
// var_dump(microtime(true) * 1000000);
// $microt = microtime(true) * 1000000;
// var_dump(intval(substr_replace(microtime(true) * 1000000, unique_id(), 3, 0)));
// var_dump(intval(substr($microt, 0, 5) . unique_id(10) . substr($microt, 5)));


// var_dump(strtoupper(_tvc_(22)));
// var_dump(custom_random());
// var_dump(strtolower("/products/{categories}/555/{id}/hello"));
// var_dump(substr($microt, 0, 4));
// var_dump(random_bytes(32));
// var_dump(random_int(1, 100));
// var_dump(_tvc_());
// var_dump(unique_id());












die();

$request_uri =  "/products/test";
$setup_uri =  "/products";

// $request_uri = "/search";
// $setup_uri = "/search";

// var_dump();
$uri_path_rule = count(explode("/", $request_uri)) > 2;
// yang baik = harus diatas int 2
$temp = explode("/{", $setup_uri);
var_dump(count($temp));
$consistant_uri_path = str_contains($request_uri,$temp[0]);

var_dump($uri_path_rule);
var_dump($consistant_uri_path);





die();

// $temp = "/jhuanes/////////////";

// $uri_sanitize_slashes = array_filter(explode("/", $temp), function($char) {
//     if (!empty($char)) return true;
// });

// $test = "/{$uri_sanitize_slashes[1]}";

// if () {
//     $test = "{$test}/";
// }

// var_dump($test);

var_dump(str_split("search"));


//  ===================================



        // $uri_sanitize_slashes = array_filter(str_split($_SERVER["REQUEST_URI"]), function($char) {
        //     // if (!empty($char)) return true;
        //     var_dump($char);
        // });

        $temp = $_SERVER["REQUEST_URI"];

        while (true) {
            if (substr($temp, -1) != "/") break;
            $temp = substr($_SERVER["REQUEST_URI"], 0, -1);
        }

        var_dump($temp);


        // var_dump($uri_sanitize_slashes[1]);

        // var_dump(explode("/", $uri_path)[1]);   

        // pake array filter -> substr |loop|

        // $test = ;
        // $hehe = substr($_SERVER["REQUEST_URI"], 0, -1);

        // var_dump($test);
        // var_dump($hehe);

        return true;
        // return "/{$uri_sanitize_slashes[1]}" == $_SERVER["REQUEST_URI"];

?>
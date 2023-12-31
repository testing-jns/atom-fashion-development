<?php 

# Created by Jhuanes Septinus

require_once "../app/vendor/autoload.php";
require_once "../app/config/initialize-config.php";

use \core\Route;

# Don't forget to create a  class file in controller

// var_dump($_SERVER);

Route::databaseHandler();

// Route::maintenanceMode();

Route::add("GET", "/");
Route::add("GET", "/about");

Route::add(["GET", "POST"], "/signup");
Route::add(["GET", "POST"], "/login");

Route::add(["GET", "POST"], "/search/{item}");
Route::add("GET", "/verify/{key}");

Route::add(["GET", "POST"], "/admin/login");

Route::add("GET", "/admin", "/admin/dash");
Route::add("GET", "/admin/dash");

Route::add(["GET", "POST"], "/admin/add/{item}");
Route::add("ALL", "/admin/add", "/admin");

Route::add("GET", "/user", "/user/settings");
Route::add("GET", "/user/settings");



Route::add("GET", "/admin/show", "/admin");
Route::add("GET", "/admin/show/{item}");

Route::add("GET", "/products");
Route::add("GET", "/products/detail/{code}");

Route::add("GET", "/category", "/products");
Route::add("GET", "/category/{category}");

Route::add(["GET", "POST"], "/user/cart");
Route::add(["GET", "POST"], "/user/wishlist");

// category (7)

// products (all)

// category (mens, woman)















// Route::add("GET", "/hallo/guys");
// Route::add("GET", "/hallo");
// Route::add("GET", "/woi");
// Route::add(["GET", "POST"], "/search");
// Route::add(["GET", "POST", "PUT"], "/search/test");
// Route::add(["GET", "POST", "PUT"], "/search/{search_value}");
// Route::add(["GET", "POST", "PUT"], "/search/{search_value}/woi");
// Route::add(["GET", "POST", "PUT"], "/products/{categories}/555/{id}/hello");
// Route::add("GET", "/products/detail/?nama=ertert");
// Route::add("GET", "/products?nama=ertert");
// Route::add("GET", "/products/{product}");
// Route::add("GET", "/user/{id}");
// Route::add("GET", "/user/settings/{id}");


// Route::add(["GET", "HEAD", "PUT", "POST", "PATCH", "TRACE", "OPTIONS", "DELETE"], "/");

Route::run();
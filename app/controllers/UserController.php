<?php

use core\Controller;
use middlewares\CookieManager;

class UserController extends Controller {
    public function settings(...$args) {
        $cookie_manager_response = CookieManager::verify();
        if (!$cookie_manager_response["success"]) $this->redirect("/login");

        $responses = $this->model("customers/InfoCustomers")->execute()->arrayAssoc();
        $this->view("user/settings", $responses);
    }

    public function wishlist(...$args) {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $response = $this->model("customers/WishlistCustomers")->execute()->json(false);
            die($response);
        }

        $cookie_manager_response = CookieManager::verify();
        if (!$cookie_manager_response["success"]) $this->redirect("/login");

        $responses = $this->model("customers/InfoCustomers")->execute()->arrayAssoc();
        $this->view("user/wishlist", $responses);
    }
    public function cart(...$args) {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $response = $this->model("customers/CartCustomers")->execute()->json(false);
            die($response);
        }

        $cookie_manager_response = CookieManager::verify();
        if (!$cookie_manager_response["success"]) $this->redirect("/login");
        
        $responses = $this->model("customers/InfoCustomers")->execute()->arrayAssoc();
        $this->view("user/cart", $responses);
    }




}
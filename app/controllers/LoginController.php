<?php 

use core\Controller;
use middlewares\CookieManager;

class LoginController extends Controller {
    public function index(...$args) : void {
        $cookie_manager_response = CookieManager::verify();
        if ($cookie_manager_response["success"]) $this->redirect("/user/settings");


        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $response = $this->model("customers/LoginCustomers")->execute("manualLogin")->json();
            die($response);
        }

        if (!empty($_GET["code"])) {
            $response = $this->model("customers/LoginCustomers")->execute("loginWithGoogleAuth")->arrayAssoc();
        }

        $this->view("login/index", $response ?? []);
    }
}
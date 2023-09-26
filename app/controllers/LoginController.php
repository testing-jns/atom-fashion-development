<?php 

use core\Controller;

class LoginController extends Controller {
    public function index(...$args) : void {
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
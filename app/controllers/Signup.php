<?php 

use core\Controller;

class Signup extends Controller {
    public function index(...$args) : void {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $response = $this->model("customers")->action("signup")->json();
            die($response);
        }

        if (!empty($_GET["code"])) {
            $response = $this->model("customers")->action("signupWithGoogleAuth")->arrayAssoc();
        }
        
        $this->view("signup/index", $response ?? []);
    }
}
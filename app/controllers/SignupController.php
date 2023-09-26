<?php 

use core\Controller;

class SignupController extends Controller {
    public function index(...$args) : void {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $response = $this->model("customers/SignupCustomers")->execute("manualSignup")->json();
            die($response);
        }

        if (!empty($_GET["code"])) {
            $response = $this->model("customers/SignupCustomers")->execute("signupWithGoogleAuth")->arrayAssoc();
        }
        
        $this->view("signup/index", $response ?? []);
    }
}
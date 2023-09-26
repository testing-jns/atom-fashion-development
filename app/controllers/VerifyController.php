<?php

use core\Controller;

class VerifyController extends Controller {
    public function index(...$args) {
        $args["type"] = "signup";
        $response = $this->model("customers/VerifyCustomers")->execute($args)->arrayAssoc();
        $this->view("verify/index", $response);
    }
}
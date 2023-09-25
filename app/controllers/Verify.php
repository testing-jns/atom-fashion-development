<?php

use core\Controller;

class Verify extends Controller {
    public function index(...$args) {
        $args["type"] = "signup";
        $response = $this->model("customers")->action("verify", $args)->arrayAssoc();
        $this->view("verify/index", $response);
    }
}
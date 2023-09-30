<?php 

use core\Controller;

class HomeController extends Controller {
    public function index(...$args) : void {
        $responses = $this->model("customers/InfoCustomers")->execute()->arrayAssoc();
        
        $this->view("home/index", $responses);
    }
}

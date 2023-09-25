<?php 

use core\Controller;

class Maintenance extends Controller {
    public function index(...$args) : void {
        $this->view("maintenance/index");
    }
}
<?php 

use core\Controller;

class MaintenanceController extends Controller {
    public function index(...$args) : void {
        $this->view("maintenance/index");
    }
}
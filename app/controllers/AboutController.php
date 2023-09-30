<?php

use core\Controller;

class AboutController extends Controller {
    public function index(...$args) {
        $this->view("about/index");
    }
}
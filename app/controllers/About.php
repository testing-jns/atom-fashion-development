<?php

use core\Controller;

class About extends Controller {
    public function index(...$args) {
        var_dump($args);
    }
}
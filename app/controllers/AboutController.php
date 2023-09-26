<?php

use core\Controller;

class AboutController extends Controller {
    public function index(...$args) {
        var_dump($args);
    }
}
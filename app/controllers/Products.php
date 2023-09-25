<?php 

use core\Controller;

class Products extends Controller {
    public function index(...$args) : void {
        var_dump($args);
        // $all_students = $this->model("Students")->getStudents();
        // $all_students["title"] = "XI SIJA 2 : Home";
        // $view_data = $all_students;
        // $this->view("home/index", $view_data);
        $this->view("products/index");
    }
}

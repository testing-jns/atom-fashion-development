<?php 

use core\Controller;

class Login extends Controller {
    public function index(...$args) : void {
        // var_dump($_POST);
        // var_dump($args);
        // $all_students = $this->model("Students")->getStudents();
        // $all_students["title"] = "XI SIJA 2 : Home";
        // $view_data = $all_students;
        // $this->view("home/index", $view_data);
        $this->view("login/index");
    }
}
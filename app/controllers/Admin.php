<?php 

use core\Controller;

class Admin extends Controller {
    // private function render_templates(callable $custom_pages) : void {
    //     $this->view("admin/templates-page/header-start");
    //     $this->view("admin/templates-page/header");
    //     $custom_pages();
    //     $this->view("admin/templates-page/footer");
    // }
    public function index(...$args) : void {
        var_dump($args);
        // $all_students = $this->model("Students")->getStudents();
        // $all_students["title"] = "XI SIJA 2 : Home";
        // $view_data = $all_students;
        // $this->view("home/index", $view_data);
        $this->view("admin/index");
    }
    public function dash(...$args) : void {
        // $this->render_templates(function() {
        //     $this->view("admin/dash/index");
        //     $this->view("admin/dash/js-custom");
        // });
        $this->view("admin/dash/index");
    }

    public function add(...$args) : void {
        if ($_SERVER["REQUEST_METHOD"] === "POST" && $args[0] === "product") {
            $response = $this->model("products")->action("insert")->json();
            die($response);
        }

        
        $this->view("admin/add/{$args[0]}");

        // $this->render_templates(function() use($args) {
        //     $this->view("admin/add/{$args[0]}/css-custom");
        //     $this->view("admin/add/{$args[0]}/index");
        //     $this->view("admin/add/{$args[0]}/js-custom");
        // });
    }

}

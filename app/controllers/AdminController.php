<?php 

use core\Controller;
use middlewares\CookieManager;

class AdminController extends Controller {
    // private function render_templates(callable $custom_pages) : void {
    //     $this->view("admin/templates-page/header-start");
    //     $this->view("admin/templates-page/header");
    //     $custom_pages();
    //     $this->view("admin/templates-page/footer");
    // }
    // public function index(...$args) : void {
    //     var_dump($args);
    //     // $all_students = $this->model("Students")->getStudents();
    //     // $all_students["title"] = "XI SIJA 2 : Home";
    //     // $view_data = $all_students;
    //     // $this->view("home/index", $view_data);
    //     $this->view("admin/index");
    // }
    public function dash(...$args) : void {
        $cookie_manager_response = CookieManager::verify();
        if (!$cookie_manager_response["success"]) $this->redirect("/admin/login");
        // $this->render_templates(function() {
        //     $this->view("admin/dash/index");
        //     $this->view("admin/dash/js-custom");
        // });
        $this->view("admin/dash/index");
    }

    public function add(...$args) : void {
        $cookie_manager_response = CookieManager::verify();
        if (!$cookie_manager_response["success"]) $this->redirect("/admin/login");
        
        if ($_SERVER["REQUEST_METHOD"] === "POST" && $args["item"] === "product") {
            $response = $this->model("products/AddProducts")->execute()->json();
            die($response);
        }

        $this->view("admin/add/{$args['item']}");
    }

    public function login(...$args) : void {
        $cookie_manager_response = CookieManager::verify();
        if ($cookie_manager_response["success"]) $this->redirect("/admin/dash");


        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $response = $this->model("admin/LoginAdmin")->execute()->arrayAssoc();
            if ($response["results"]["success"]) $this->redirect("/admin/dash");
        }

        $this->view("admin/login/index");
    }
    // public function show(...$args) : void {
    //     if ($_SERVER["REQUEST_METHOD"] === "POST" && $args["item"] === "products") {
    //         $response = $this->model("products")->action("show")->json();
    //         die($response);
    //     }

    //     $this->view("admin/show/{$args['item']}");
    // }

}

<?php 

use core\Controller;

class ProductsController extends Controller {
    public function index(...$args) : void {
        $responses = $this->model("customers/InfoCustomers")->execute()->arrayAssoc();
        $this->view("products/index", $responses);
    }

    public function detail(...$args) {
        $is_product_exist = $this->model("products/DetailProducts")->execute($args["code"]);
        if (!$is_product_exist) die($this->view("warning/404"));

        $responses = $this->model("customers/InfoCustomers")->execute()->arrayAssoc();
        $responses["results"]["code"] = $args["code"];
        $this->view("products/detail", $responses);
    }
}

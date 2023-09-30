<?php 

use core\Controller;

class CategoryController extends Controller {
    public function index(...$args) : void {
        $is_product_exist = $this->model("products/CategoryProducts")->execute($args["category"]);
        if (empty($is_product_exist)) die($this->view("warning/404"));

        $responses = $this->model("customers/InfoCustomers")->execute()->arrayAssoc();
        $responses["results"]["category"] = $args["category"];
        $this->view("category/category", $responses);
    }
}

<?php 

require_once PATH_APP . "models/Products.model.php";

class DetailProducts extends Products {
    public function __construct() {
        parent::__construct();
        $this->on_action = "detail product";
    }


    public function execute($code) {
        $sql = "SELECT code, `name`, category, price, discount, rating, `description`, stock, sold, max_purchase, thumbnail_id FROM products WHERE code = :code";
        $bind_values = [
            ":code" => $code
        ];
        $response = $this->db->query($sql)->bindValue($bind_values)->execute();
        return $response->result();
    }

}
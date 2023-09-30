<?php 

require_once PATH_APP . "models/Products.model.php";

class CategoryProducts extends Products {
    public function __construct() {
        parent::__construct();
        $this->on_action = "category product";
    }

    private function getProductsByGender($category) {
        $sql = "SELECT code, `name`, category, price, discount, rating, thumbnail_id FROM products WHERE for_gender = :for_gender or for_gender = :for_gender_all";
        $bind_values = [
            ":for_gender" => $category,
            ":for_gender_all" => "all"
        ];
        $response = $this->db->query($sql)->bindValue($bind_values)->execute();
        return $response->resultAll();
    }

    private function isGenderCategory($category) {
        if (!in_array($category, ["man", "woman"])) return;
        return $this->getProductsByGender($category);
    }

    public function execute($category) {
        $category_gender = $this->isGenderCategory($category);
        if (!empty($category_gender)) return $category_gender;
        
        $sql = "SELECT code, `name`, category, price, discount, rating, thumbnail_id FROM products WHERE category = :category";
        $bind_values = [
            ":category" => $category
        ];
        $response = $this->db->query($sql)->bindValue($bind_values)->execute();
        return $response->resultAll();
    }

}
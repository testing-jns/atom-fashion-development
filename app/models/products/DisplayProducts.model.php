<?php 

require_once PATH_APP . "models/Products.model.php";

class DisplayProducts extends Products {
    public function __construct() {
        parent::__construct();
        $this->on_action = "display product";
    }

    public function categoryList() {
        $sql = "SELECT count(category) as total, category FROM products GROUP BY category";
        $response = $this->db->query($sql)->execute();
        return $response->resultAll();
    }

    public function newArrivals() {
        $sql = "SELECT code, `name`, category, price, discount, thumbnail_id FROM products ORDER BY code DESC LIMIT 8";
        $response = $this->db->query($sql)->execute();
        return $response->resultAll();
    }
    
    public function trending() {
        $sql = "SELECT code, `name`, category, price, discount, thumbnail_id FROM products WHERE on_trending = 'Y' ORDER BY code DESC LIMIT 8";
        $response = $this->db->query($sql)->execute();
        return $response->resultAll();
    }

    public function topRated() {
        $sql = "SELECT code, `name`, category, price, discount, thumbnail_id FROM products WHERE rating = 5 LIMIT 8";
        $response = $this->db->query($sql)->execute();
        return $response->resultAll();
    }
    
    public function dealOfTheDay() {
        $sql = "SELECT code, `name`, category, price, stock, sold, discount, rating, `description`, thumbnail_id FROM products WHERE discount > 0 ORDER BY code DESC";
        $response = $this->db->query($sql)->execute();
        return $response->resultAll();
    }
    
    public function bestSellers() {
        $sql = "SELECT code, `name`, category, price, discount, rating, thumbnail_id FROM products WHERE best_seller = 'Y' ORDER BY code DESC LIMIT 4";
        $response = $this->db->query($sql)->execute();
        return $response->resultAll();
    }
    
    public function miniProductsGallery() {
        $sql = "SELECT code, `name`, category, price, discount, rating, thumbnail_id FROM products ORDER BY code ASC LIMIT 12";
        $response = $this->db->query($sql)->execute();
        return  $response->resultAll();
    }

    public function allProducts() {
        $sql = "SELECT code, `name`, category, price, discount, rating, thumbnail_id FROM products ORDER BY code ASC LIMIT 32";
        $response = $this->db->query($sql)->execute();
        return $response->resultAll();
    }

}
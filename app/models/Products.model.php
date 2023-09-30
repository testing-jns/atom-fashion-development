<?php 

use \core\Database;

class Products {
    protected $db;
    protected $on_action;
    protected $query_status = false;
    protected $error_mess = "";

    protected function __construct() {
        $this->db = new Database();
    }

    private function responses() {
        $responses = [
            "meta" => [
                "action" => $this->on_action
            ],
            "results" => [
                "success" => $this->query_status
            ]
        ];
        
        if (!$this->query_status) {
            $responses["results"]["error_mess"] = $this->error_mess;
        }
        
        return $responses;
    }

    protected function json() {
        return json_encode($this->responses());
    }

    protected function arrayAssoc() {
        return $this->responses();
    }



    public function toRupiah($price) {
        if (strlen($price) <= 6) {
          return "Rp. " . substr_replace($price, "", -3) . "K";
        }
      
        $price = intval(substr_replace($price, "", -4)) / 100;
        return "Rp. " . $price . "jt";
      }
      
      
    public function getProductImages($thumbnail_id, $multi_images = null) {
        $sql = "SELECT `image` FROM thumbnails WHERE id = '$thumbnail_id'";
        $product_image = $this->db->query($sql)->execute();
        if ($multi_images) return $product_image->resultAll();
        return $product_image->result()->image;
      }
      
    public function getDiscount($price, $discount) {
        if ($discount === 0) return $price;
        return $price - ($price / $discount);
      }
      

}


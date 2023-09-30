<?php 

require_once PATH_APP . "models/Customers.model.php";

use \middlewares\CookieManager;

class WishlistCustomers extends Customers {
    private $wishlist_id;
    private $product_code;
    public function __construct() {
        parent::__construct();
        $this->on_action = "customer wishlist";
    }

    private function isDuplicateProduct() {
        $this->checkCustomerWishlistID();

        $sql = "SELECT COUNT(*) as total FROM `whislists` WHERE product_code = '$this->product_code' and id = '$this->wishlist_id'";
        $response = $this->db->query($sql)->execute();
        $result = $response->result();

        $is_duplicate = $result->total > 0;

        if ($is_duplicate) {
            $this->error_mess = "Duplicate product!";
        }

        return $is_duplicate;
    }

    private function checkCustomerWishlistID() {
        $sql = "SELECT whislist_id FROM customers WHERE email = '$this->email'";
        $response = $this->db->query($sql)->execute();
        $result = $response->result();

        if (empty($result->whislist_id)) {
            $wishlist_id = "WISH_" . strtoupper(custom_random(16));
            $sql = "UPDATE customers SET whislist_id = '$wishlist_id' WHERE email = '$this->email'";
            $response = $this->db->query($sql)->execute();
            $this->wishlist_id = $wishlist_id;
            return;
        }

        $this->wishlist_id = $result->whislist_id;
    }

    private function addToWishlist() {
        $this->checkCustomerWishlistID();

        $sql = "INSERT INTO whislists (id, product_code) VALUES (:id, :product_code)";
        $bind_values = [
            ":id" => $this->wishlist_id,
            ":product_code" => $this->product_code
        ];
        $response = $this->db->query($sql)->bindValue($bind_values)->execute();
        // $result = $response->result();
    }

    public function execute() {
        $cookie_response = CookieManager::get();
        if (!$cookie_response["success"]) return $this;

        $this->email = $cookie_response["results"]["email"];

        $this->product_code = $_POST["code"];


        if ($this->isDuplicateProduct()) return $this;

        $this->addToWishlist();

        $this->query_status = true;
        return $this;
    }

}
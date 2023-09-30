<?php 

require_once PATH_APP . "models/Customers.model.php";

use \middlewares\CookieManager;

class CartCustomers extends Customers {
    private $cart_id;
    private $product_code;
    public function __construct() {
        parent::__construct();
        $this->on_action = "customer cart";
    }

    private function isDuplicateProduct() {
        $this->checkCustomerCartID();

        $sql = "SELECT COUNT(*) as total FROM `carts` WHERE product_code = '$this->product_code' and id = '$this->cart_id'";
        $response = $this->db->query($sql)->execute();
        $result = $response->result();

        $is_duplicate = $result->total > 0;

        if ($is_duplicate) {
            $this->error_mess = "Duplicate product!";
        }

        return $is_duplicate;
    }

    private function checkCustomerCartID() {
        $sql = "SELECT cart_id FROM customers WHERE email = '$this->email'";
        $response = $this->db->query($sql)->execute();
        $result = $response->result();

        if (empty($result->cart_id)) {
            $cart_id = "CART_" . strtoupper(custom_random(16));
            $sql = "UPDATE customers SET cart_id = '$cart_id' WHERE email = '$this->email'";
            $response = $this->db->query($sql)->execute();
            $this->cart_id = $cart_id;
            return;
        }

        $this->cart_id = $result->cart_id;
    }

    private function checkWhislistProduct() {
        $sql = "SELECT whislist_id FROM customers WHERE email = '$this->email'";
        $response = $this->db->query($sql)->execute();
        $result = $response->result();
        $wishlist_id = $result->whislist_id;

        $sql = "SELECT COUNT(*) as total FROM `whislists` WHERE id = '$wishlist_id' and product_code = '$this->product_code'";
        $response = $this->db->query($sql)->execute();
        $result = $response->result();

        if ($result->total > 0) {
            $sql = "DELETE FROM `whislists` WHERE id = '$wishlist_id' and product_code = '$this->product_code'";
            $response = $this->db->query($sql)->execute();
        }
    }

    private function addToCart() {
        $this->checkCustomerCartID();
        $this->checkWhislistProduct();

        $quantity = $_POST["quantity"];

        $sql = "INSERT INTO carts (id, product_code, quantity) VALUES (:id, :product_code, :quantity)";
        $bind_values = [
            ":id" => $this->cart_id,
            ":product_code" => $this->product_code,
            ":quantity" => $quantity
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

        $this->addToCart();

        $this->query_status = true;
        return $this;
    }

}
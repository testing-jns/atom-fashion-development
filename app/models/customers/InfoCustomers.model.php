<?php 

require_once PATH_APP . "models/Customers.model.php";

use \middlewares\CookieManager;

class InfoCustomers extends Customers {
    private $wishlist_id;
    private $cart_id;

    public function __construct() {
        parent::__construct();
        $this->on_action = "customer info";
    }

    public function getTotalProductInCart() {
        $this->getDetails();

        $sql = "SELECT COUNT(*) as total FROM carts WHERE id = '$this->cart_id'";
        $response = $this->db->query($sql)->execute();
        return $response->result()->total;
    }

    public function getTotalProductInWishlist() {
        $this->getDetails();

        $sql = "SELECT COUNT(*) as total FROM whislists WHERE id = '$this->wishlist_id'";
        $response = $this->db->query($sql)->execute();
        return $response->result()->total;
    }

    private function getDetails() {
        $sql = "SELECT first_name, last_name, picture, whislist_id, cart_id FROM customers WHERE email = '$this->email'";
        $response = $this->db->query($sql)->execute();
        $result = $response->result();

        $this->wishlist_id = $result->whislist_id;
        $this->cart_id = $result->cart_id;

        $this->full_name = "$result->first_name $result->last_name";
        $this->picture = $result->picture;
    }

    public function execute() {
        $cookie_response = CookieManager::get();
        if (!$cookie_response["success"]) return $this;

        $this->email = $cookie_response["results"]["email"];
        $this->getDetails();
        $this->query_status = true;
        return $this;
    }

}
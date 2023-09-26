<?php 

require_once PATH_APP . "models/Customers.model.php";

use \plugins\VerifyEmail;
class VerifyCustomers extends Customers {
    public function __construct() {
        parent::__construct();
    }
    private function verify($params) {
        $type = $params["type"];
        $key = $params["key"];
    
        $email_verify_response = VerifyEmail::run($this->db, $type, $key);
    
        $this->query_status = $email_verify_response["success"];
        $this->error_mess = $email_verify_response["error_mess"] ?? "";
    
        return $this;
    }


    public function execute($params) {
        return $this->verify($params);
    }
}

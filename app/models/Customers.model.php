<?php 

use \core\Database;

// Jadi nanti ngebuat folder yang sesuai sama model - modelnya, pake namescpace models\nama_model\class
// Mungkin enaknya, nanti dibuat static
// Jadi file yang ada di models (bukan sub models) itu yang ngemanage alur programnya

class Customers {
    protected $db;
    protected $on_action;
    protected $customer_id;
    protected $email;
    protected $query_status = false;
    protected $error_mess = "";
    protected $response_payload = [];

    protected function __construct() {
        $this->db = new Database();
    }

    private function responses() {
        $responses = [
            "meta" => [
                "action" => $this->on_action
            ],
            "result" => [
                "success" => $this->query_status,
                "email" => $this->email
            ]
        ];
        
        if (!$this->query_status) {
            $responses["result"]["error_mess"] = $this->error_mess;
        }
        
        return $responses;
    }

    public function json() {
        return json_encode($this->responses());
    }

    public function arrayAssoc() {
        return $this->responses();
    }


}

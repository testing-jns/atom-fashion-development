<?php 

use \core\Database;

// Jadi nanti ngebuat folder yang sesuai sama model - modelnya, pake namescpace models\nama_model\class
// Mungkin enaknya, nanti dibuat static
// Jadi file yang ada di models (bukan sub models) itu yang ngemanage alur programnya

class Customers {
    protected $db;
    protected $on_action;
    protected $customer_id;
    protected $full_name;
    protected $picture;
    protected $email;
    protected $query_status = false;
    protected $error_mess = "";

    protected function __construct() {
        $this->db = new Database();
    }

    private function responses($extra_info) {
        $responses = [
            "meta" => [
                "action" => $this->on_action
            ],
            "results" => [
                "success" => $this->query_status,
            ]
        ];

        $extra_info_response = [
            "email" => $this->email,
            "full_name" => $this->full_name,
            "picture" => $this->picture
        ];

        if ($extra_info) {
            $responses["results"] = array_merge($responses["results"], $extra_info_response);
        }
        
        if (!$this->query_status) {
            $responses["results"]["error_mess"] = $this->error_mess;
        }
        
        return $responses;
    }

    public function json($extra_info = true) {
        return json_encode($this->responses($extra_info));
    }

    public function arrayAssoc($extra_info = true) {
        return $this->responses($extra_info);
    }


}

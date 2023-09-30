<?php 

use \core\Database;

class Admin {
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
                "success" => $this->query_status,
            ]
        ];

        if (!$this->query_status) {
            $responses["results"]["error_mess"] = $this->error_mess;
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

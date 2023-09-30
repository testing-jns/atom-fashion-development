<?php 

require_once PATH_APP . "models/Admin.model.php";

use \middlewares\CookieManager;

class LoginAdmin extends Admin {
    private $username;
    private $password;
    private $password_from_db;

    
    public function __construct() {
        parent::__construct();
    }

    private function isValidate() {
        $is_fields_fill = array_filter($_POST, fn($field) => !empty($field));
        if (count($is_fields_fill) !== count($_POST)) {
            $this->error_mess = "Please fill all fields!";
            return;
        }

        return true;
    }

    private function isUsernameExist() {
        $sql = "SELECT `password` FROM admin WHERE username = :username";
        $bind_values = [
            ":username" => $this->username
        ];

        $response = $this->db->query($sql)->bindValue($bind_values)->execute();
        $result = $response->result();

        $this->password_from_db = $result->password ?? "";

        return $result;
    }

    private function isPasswordMatch() {
        $is_password_match = password_verify($this->password, $this->password_from_db);
        if (!$is_password_match) {
            $this->error_mess = "Please check email or password!";
        }
        return $is_password_match;
    }

    public function execute() {
        $this->username = $_POST["username"];
        $this->password = $_POST["password"];

        if (!$this->isValidate()) return $this;
        if (!$this->isUsernameExist()) return $this;
        if (!$this->isPasswordMatch()) return $this;

        CookieManager::set($this->username, "superadmin");

        $this->query_status = true;
        return $this;
    }
}
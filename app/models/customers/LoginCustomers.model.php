<?php 

require_once PATH_APP . "models/Customers.model.php";

use \middlewares\GoogleAuth;

class LoginCustomers extends Customers {
    private $password;
    private $password_from_db;
    private $isEmailHasBeenActivated;


    public function __construct() {
        parent::__construct();
    }

    private function checkEmailExist() {
        $sql = "SELECT `password`, activated FROM customers WHERE email = :email";
        $bind_values = [
            ":email" => $this->email
        ];
        $response = $this->db->query($sql)->bindValue($bind_values)->execute();
        $result = $response->result();

        return $result;
    }

    private function isEmailExistWithLoginManually() {
        $result = $this->checkEmailExist();

        if (!$result) {
            $this->error_mess = "Please check email or password!";
            return;
        }
        
        $this->isEmailHasBeenActivated = $result->activated;
        $this->password_from_db = $result->password;

        return boolval($result);
    }

    private function isEmailActivated() {
        $is_activated = $this->isEmailHasBeenActivated === "Y";
        if (!$is_activated) {
            $this->error_mess = "Please activate your email $this->email";
        }
        return $is_activated;
    }

    private function isRegisteredManually() {
        $is_registered_manually = !empty($this->password_from_db);
        if (!$is_registered_manually) {
            $this->error_mess = "Your already register with Google Auth. Please login with Google!";
        }
        return $is_registered_manually;
    }

    private function isPasswordMatch() {
        $is_password_match = password_verify($this->password, $this->password_from_db);
        if (!$is_password_match) {
            $this->error_mess = "Please check email or password!";
        }
        return $is_password_match;
    }

    private function isValidate() {
        $is_fields_fill = array_filter($_POST, fn($field) => !empty($field));
        if (count($is_fields_fill) !== count($_POST)) {
            $this->error_mess = "Please fill all fields!";
            return;
        }

        return true;
    }

    private function manualLogin() {
        $this->email = $_POST["email"];
        $this->password = $_POST["password"];

        if (!$this->isValidate()) return $this;
        if (!$this->isEmailExistWithLoginManually()) return $this;
        if (!$this->isRegisteredManually()) return $this;
        if (!$this->isEmailActivated()) return $this;
        if (!$this->isPasswordMatch()) return $this;

        $this->query_status = true;
        return $this;
    }

    private function isEmailExistWithLoginGoogleAuth() {
        $result = $this->checkEmailExist();

        if (!$result) {
            $this->error_mess = "Your email not registered!";
            return;
        }

        return boolval($result);
    }
    private function loginWithGoogleAuth() {
        $google_auth_response = GoogleAuth::verify("LOGIN", $_GET["code"]);
        
        if (!$google_auth_response["success"]) {
            $this->error_mess = "Key has expired!";
            return $this;
        }
        
        $this->email = $google_auth_response["results"]["email"];
        
        if (!$this->isEmailExistWithLoginGoogleAuth()) return $this;

        $this->query_status = true;
        return $this;
    }

    public function execute($action) {
        $this->on_action = $action;
        $this->$action();
        return $this;
    }
}


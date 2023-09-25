<?php 

use \core\Database;
use \plugins\Mailler;
use \plugins\VerifyEmail;
use \middlewares\GoogleAuth;
use \middlewares\GoogleRecaptcha;

use function PHPSTORM_META\type;

class Customers {
    private $db;
    private $on_action;
    private $customer_id;
    private $email;
    private $verify_key;
    private $query_status = false;
    private $error_mess = "";

    public function __construct() {
        $this->db = new Database();
    }

    private function responses() {
        $responses = [
            "meta" => [
                "action" => $this->on_action
            ],
            "result" => [
                "success" => $this->query_status,
            ]
        ];
        
        if (!$this->query_status) {
            $responses["result"]["error_mess"] = $this->error_mess;
        }

        return $responses;
    }

    private function verify($params) {
        $type = $params["type"];
        $key = $params["key"];
    
        $email_verify_response = VerifyEmail::run($this->db, $type, $key);
    
        $this->query_status = $email_verify_response["success"];
        $this->error_mess = $email_verify_response["error_mess"] ?? "";
    
        return $this;
    }

    private function sendMail() {
        $url_verify = BASE_URL . "verify/{$this->verify_key}";
        $mailer_response = Mailler::run($this->email, $url_verify);
        if (!$mailer_response["success"]) {
            $this->error_mess = "Can't send mail!";
        }

        return $mailer_response["success"];
    }

    private function addKeyToTableVerify() {
        $this->verify_key = custom_random(30);
        $sql = "INSERT INTO verify (customer_id, `type`, `key`) VALUES ('$this->customer_id', '$this->on_action', '$this->verify_key')";
        $response = $this->db->query($sql)->execute();
        
        if (!$response->status()) {
            $this->error_mess = "Can't add verify key!";
        }

        return $response->status();
    }

    private function isValidate() {
        $is_fields_fill = array_filter($_POST, fn($field) => !empty($field));
        if (count($is_fields_fill) !== count($_POST)) {
            $this->error_mess = "Please fill all fields!";
            return;
        }

        if ($_POST["password"] !== $_POST["confirm_password"]) {
            $this->error_mess = "Password don't match!";
            return;
        }

        $recaptcha_response = GoogleRecaptcha::run($_POST["g-recaptcha-response"], $_SERVER["REMOTE_ADDR"]);
        if (!$recaptcha_response->success) {
            $this->error_mess = "Your recaptcha not valid!";
            return;
        }

        return true;
    }


    private function insertWhenSignupMannually() {
        $sql = "INSERT INTO customers (id, first_name, last_name, email, `password`) VALUES (:id, :first_name, :last_name, :email, :password)";

        $is_validate = $this->isValidate();
        if (!$is_validate) return $this;


        $bind_values = [];
        foreach ($_POST as $key => $value) {
            if ($key === "confirm_password" || $key === "g-recaptcha-response") continue;
            
            if ($key === "password") {
                $bind_values[":{$key}"] = password_hash($_POST["password"], PASSWORD_DEFAULT);
                continue;
            }
        
            $bind_values[":{$key}"] = $value;
        }


        $this->customer_id = custom_random();
        $this->email = $_POST["email"];
        $bind_values[":id"] = $this->customer_id;

        $response = $this->db->query($sql)->bindValue($bind_values)->execute();

        $this->error_mess = $response->error_message();
        
        return ["status" => $response->status()];
    }

    private function signup() {
        $response = $this->insertWhenSignupMannually();

        if (!$response["status"]) return $this;


        $success_add_key = $this->addKeyToTableVerify();
        if (!$success_add_key) return $this;

        $success_send_mail = $this->sendMail();
        if (!$success_send_mail) return $this;

        $this->query_status = true;
        return $this;
    }

    private function insertWhenSignupWithGoogleAuth($user_data) {
        $this->customer_id = custom_random();

        $sql = "INSERT INTO customers (id, first_name, last_name, email, activated, picture) VALUES (:id, :first_name, :last_name, :email, :activated, :picture)";
        $bind_values = [
            ":id" => $this->customer_id,
            ":first_name" => $user_data["first_name"],
            ":last_name" => $user_data["last_name"],
            ":email" => $user_data["email"],
            ":picture" => file_get_contents($user_data["picture"]),
            ":activated" => "Y"
        ];

        $response = $this->db->query($sql)->bindValue($bind_values)->execute();

        $this->error_mess = $response->error_message();

        return ["status" => $response->status()];
    }

    private function signupWithGoogleAuth() {
        if (!empty($_GET["error"])) return $this;

        $google_auth_response = GoogleAuth::verify($_GET["code"]);
        if (!$google_auth_response["success"]) {
            $this->error_mess = "Key has expired!";
            return $this;
        }

        $response = $this->insertWhenSignupWithGoogleAuth($google_auth_response["results"]);
        
        if (!$response["status"]) return $this;

        $this->query_status = true;
        return $this;

    }

    public function action($action, $args = null) {
        $this->on_action = $action;
        $this->$action($args);
        return $this;
    }

    public function json() {
        return json_encode($this->responses());
    }

    public function arrayAssoc() {
        return $this->responses();
    }


}

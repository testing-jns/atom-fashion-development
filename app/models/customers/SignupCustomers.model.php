<?php 

require_once PATH_APP . "models/Customers.model.php";

use \plugins\Mailler;
use \middlewares\GoogleAuth;
use \middlewares\GoogleRecaptcha;

class SignupCustomers extends Customers {
    private $type = "signup";
    private $verify_key;

    public function __construct() {
        parent::__construct();
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
        $sql = "INSERT INTO verify (customer_id, `type`, `key`) VALUES ('$this->customer_id', '$this->type', '$this->verify_key')";
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

    private function checkDuplicateEmail($message) {
        if (str_contains($message, "1062 Duplicate entry") && str_contains($message, "for key 'customers.email'")) {
            $this->error_mess = "Email {$this->email} already register!";
        }
        
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

        $this->email = $_POST["email"];
        $bind_values[":id"] = $this->customer_id;

        $response = $this->db->query($sql)->bindValue($bind_values)->execute();

        $this->checkDuplicateEmail($response->error_message());
        
        return ["status" => $response->status()];
    }

    private function manualSignup() {
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
        $image_name = custom_random(28) . ".png";
        $image_path = PATH_APP . "../public/assets/img/users/";
        $google_account_picture = file_get_contents($user_data["picture"]);
        file_put_contents($image_path . $image_name, $google_account_picture);


        $sql = "INSERT INTO customers (id, first_name, last_name, email, activated, picture) VALUES (:id, :first_name, :last_name, :email, :activated, :picture)";

        $bind_values = [
            ":id" => $this->customer_id,
            ":first_name" => $user_data["first_name"],
            ":last_name" => $user_data["last_name"],
            ":email" => $user_data["email"],
            ":picture" => $image_name,
            ":activated" => "Y"
        ];
        

        $response = $this->db->query($sql)->bindValue($bind_values)->execute();

        $this->checkDuplicateEmail($response->error_message());

        return ["status" => $response->status()];
    }

    private function signupWithGoogleAuth() {
        if (!empty($_GET["error"])) return $this;

        $google_auth_response = GoogleAuth::verify("SIGNUP", $_GET["code"]);
        if (!$google_auth_response["success"]) {
            $this->error_mess = "Key has expired!";
            return $this;
        }

        $this->email = $google_auth_response["results"]["email"];
        $response = $this->insertWhenSignupWithGoogleAuth($google_auth_response["results"]);
        
        if (!$response["status"]) return $this;

        $this->query_status = true;
        return $this;

    }


    public function execute($action) {
        $this->customer_id = custom_random();
        $this->on_action = $action;
        $this->$action();
        return $this;
    }


}

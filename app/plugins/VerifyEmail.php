<?php 

namespace plugins;

class VerifyEmail {
    private static $db;
    private static $status = false;
    private static $error_mess = "";


    private static function checkVerifyKey($type, $key) {
        $sql = "SELECT customer_id FROM verify WHERE `key` = '$key' and `type` = '$type'";
        $response = self::$db->query($sql)->execute();
        $result = $response->result();

        if (!$result) {
            self::$error_mess = "Key not found or has expired!";
            return;
        }

        self::changeCustomersActiveStatus($result);
    }

    private static function changeCustomersActiveStatus($result) {
        $customer_id = $result->customer_id;
        $sql = "UPDATE customers SET activated = 'Y' WHERE id = '$customer_id'";
        $response = self::$db->query($sql)->execute();

        if (!$response->status()) {
            self::$error_mess = "Can't change customer active status!";
            return;
        }

        self::removeKeyOnTableVerify($customer_id);
    }
    private static function removeKeyOnTableVerify($customer_id) {
        $sql = "DELETE FROM verify WHERE customer_id = '$customer_id'";
        $response = self::$db->query($sql)->execute();

        if (!$response->status()) {
            self::$error_mess = "Can't remove verifd=y key on table!";
            return;
        }

        self::$status = true;
    }
    private static function response() {
        $response = ["success" => self::$status];
        if (!self::$status) {
            $response["error_mess"] = self::$error_mess;
        }

        return $response;
    }

    public static function run($db, $type, $key) {
        self::$db = $db;
        self::checkVerifyKey($type, $key);
        return self::response();
    }
}
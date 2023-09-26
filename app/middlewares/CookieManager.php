<?php 

namespace middlewares;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\SignatureInvalidException;

class CookieManager {
    private static const COOKIE_NAME = "X-ATOM-FASHION";
    private static const JWT_EXPIRED_TIME = 3600;
    private static const ALGORITHM = "HS256";
    private static $success = false;
    private static $error_message;
    private static $jwt_token;
    private static function payloads($email, $role) {
        return [
            "email" => $email,
            "role" => $role,
            "iat" => time()
        ];
    }

    private static function createJWT($mail, $role) {
        self::$jwt_token = JWT::encode(self::payloads($mail, $role), JWT_KEY, self::ALGORITHM);
    }

    private static function setCookie() {
        setcookie(self::COOKIE_NAME, self::$jwt_token, time() + self::JWT_EXPIRED_TIME, "", "", true, true);
    }

    private static function getCookie() {
        return $_COOKIE[self::COOKIE_NAME] ?? false;
    }


    public static function verify() {
        try {
            $payloads = JWT::decode(self::getCookie(), new Key(JWT_KEY, self::ALGORITHM));
        } catch (SignatureInvalidException $err) {
            self::$error_message = $err->getMessage();
        }
    }
    private static function response() {
        return ["success" => self::$success];
    }

//     public static function check() {
//         try {
//     $current_cookie = $_COOKIE[self::COOKIE_NAME];
//     $decoded = JWT::decode($current_cookie, new Key(JWT_KEY, 'HS256'));
//     var_dump($decoded);
// } catch (SignatureInvalidException $err) {
//     var_dump($err->getMessage());
// }
//         return ["success" => false, "message" => "Not valid"];
//     }

    // payloads [email, role = customer]

    // bisa pake session id biar jadi pembeda tokennya, trus session id nya dimasukin ke database, tapi ya selalu ngehit database nya

    // verify => public
    // set cookie
    // get current cookie
}
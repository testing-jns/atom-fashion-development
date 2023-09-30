<?php 

namespace middlewares;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\SignatureInvalidException;

class CookieManager {
    private const COOKIE_NAME = "X-ATOM-FASHION";
    private const JWT_EXPIRED_TIME = 3600;
    private const ALGORITHM = "HS256";
    private static $success = false;
    private static $error_message = "";
    private static $jwt_token;
    private static $jwt_payloads_response = null;

    private static function payloads($email, $role) {
        return [
            "email" => $email,
            "role" => $role,
            "iat" => time()
        ];
    }

    private static function createJWT($email, $role) {
        self::$jwt_token = JWT::encode(self::payloads($email, $role), JWT_KEY, self::ALGORITHM);
    }

    public static function set($email, $role) {
        self::createJWT($email, $role);
        self::$success = setcookie(self::COOKIE_NAME, self::$jwt_token, time() + self::JWT_EXPIRED_TIME, "", "", true, true);
        return self::response();
    }
    public static function destroy() {
        self::$success = setcookie(self::COOKIE_NAME, "", time() - self::JWT_EXPIRED_TIME, "", "", true, true);
        return self::response();
    }

    private static function getCookie() {
        return $_COOKIE[self::COOKIE_NAME] ?? false;
    }

    public static function verify() {
        if (empty(self::getCookie())) return self::response();

        try {
            self::$jwt_payloads_response = JWT::decode(self::getCookie(), new Key(JWT_KEY, self::ALGORITHM));
            self::$success = true;
        } catch (SignatureInvalidException $err) {
            self::$error_message = $err->getMessage();
        }

        return self::response();
    }

    public static function get() {
        self::verify();

        if (empty(self::$jwt_payloads_response)) return self::response();

        self::$success = true;
        $results = json_decode(json_encode(self::$jwt_payloads_response), true);

        $responses = self::response();
        $responses["results"] = $results;

        return $responses;
    } 

    private static function response() {
        return ["success" => self::$success];
    }
}
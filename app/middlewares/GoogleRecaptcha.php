<?php 

namespace middlewares;

class GoogleRecaptcha {
    private static function params($google_response, $remote_IP) {
        return [
            "response" => $google_response,
            "secret" => GOOLE_RECAPTCHA_SECRET_KEY,
            "remoteip" =>$remote_IP
        ];
    }
    
    public static function run($google_response, $remote_IP) {
        $url = GOOLE_RECAPTCHA_ENDPOINT . "?" . http_build_query(self::params($google_response, $remote_IP));
        $result = file_get_contents($url);
        return json_decode($result);
    }
}
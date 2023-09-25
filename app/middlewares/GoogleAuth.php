<?php 

namespace middlewares;
use Google\Client;
use Google\Service\Oauth2;

class GoogleAuth {
    private static $google_client;
    private static $success = false;

    private static function initialize() {
        self::$google_client = new Client();

        self::$google_client->setClientId(GOOGLE_CLIENT_ID);
        self::$google_client->setClientSecret(GOOGLE_CLIENT_SECRET);
        self::$google_client->setRedirectUri(GOOGLE_AUTH_REDIRECT_URI);

        self::$google_client->addScope("profile");
        self::$google_client->addScope("email");
    }

    public static function getAuthUrl() {
        self::initialize();
        return self::$google_client->createAuthUrl();
    }

    private static function response($other_data = null) {
        $reponses = ["success" => self::$success];
        if (!empty($other_data)) {
            $reponses["results"] = $other_data;
        }
        return $reponses;
    }
    
    public static function verify($code) {
        self::initialize();
        $token = self::$google_client->fetchAccessTokenWithAuthCode($code);
        
        if (!empty($token["error"])) return self::response();
        
        self::$success = true;
        
        self::$google_client->setAccessToken($token["access_token"]);
        $google_service = new Oauth2(self::$google_client);
        $user_data = $google_service->userinfo->get();

        $user_data = [
            "first_name" => $user_data->givenName,
            "last_name" => $user_data->familyName,
            "email" => $user_data->email,
            "picture" => $user_data->picture
        ];

        return self::response($user_data);
    }
}
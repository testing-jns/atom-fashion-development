<?php

namespace core;
use \core\Controller;

class Route {
//    private static string $controller_name = "Home";
//    private static object $controller;
//    private static string $method_name = "index";
//    private static array $uri_dispart_path;
//    private static array $params = [];
//    private static array $routes = [];
//    private static string $warning_controller_name = "Warning";

    private static $controller_name = "HomeController";
    private static $controller;
    private static $method_name = "index";
    private static $real_uri_path;
    private static $uri_dispart_path;
    private static $params = [];
    private static $params_query = [];
    private static $route_active;
    private static $routes = [];
    private static $default_route = [
        "request_methods" => "GET",
        "uri_path" => "/",
        "redirect" => null
    ];
    private static $warning_controller_name = "WarningController";
    private static $maintenance_controller_name = "MaintenanceController";
    private static array $uri_paths_custom;
    private static array $real_uri_paths;

    public static function add($request_methods, string $uri_path_route, string $redirect = null) : void {
        self::$routes[] = [
            "request_methods" => preg_replace("/\s/", "", $request_methods),
            "uri_path" => rtrim(preg_replace("/\s/", "", $uri_path_route), "/") ?: "/",
            "redirect" => $redirect
        ];
    }
    private static function defineControllerClass() : void {
        require_once PATH_APP . "controllers/" . self::$controller_name . ".php";
        self::$controller = new self::$controller_name;
    }

    private static function parseURL() : void {
        $uri_path = $_SERVER["REQUEST_URI"];
        $uri_parsing = parse_url($uri_path);
        parse_str($uri_parsing["query"] ?? "", self::$params_query);
        if ($uri_parsing["path"] === "/") {
            self::$real_uri_path = "/";
            return;
        }
        self::$real_uri_path = rtrim($uri_parsing["path"], "/");
    }

    private static function uriDispartPath() : void {
        $uri_path = trim(self::$real_uri_path, "/");
        self::$uri_dispart_path = (!$uri_path) ? [] : explode("/", $uri_path);
    }

    private static function checkRedirectAction() : void {
        foreach (self::$routes as $route) {
            if ($route["uri_path"] !== self::$real_uri_path) continue;
            if (!$route["redirect"]) continue;

            $destination = trim($route["redirect"], "/");   
            header("Location: " . BASE_URL . "{$destination}", true, 301);
            die();
        }
    }


    private static function distributeURL() : void {
        self::uriDispartPath();
        
        if (empty(self::$uri_dispart_path)) {
            self::defineControllerClass();
            return;
        }

        if (file_exists(PATH_APP . "controllers/" . ucfirst(self::$uri_dispart_path[0]) . "Controller.php")) {
            self::$controller_name = ucfirst(self::$uri_dispart_path[0]) . "Controller";
            unset(self::$uri_dispart_path[0]);
        }

        self::defineControllerClass();

        if (!empty(self::$uri_dispart_path[1])) {
            $custom_uri_param = "/(?={)(.*?)(?<=})/";   
            preg_match($custom_uri_param, self::$uri_paths_custom[2], $diff_res);

            if (empty($diff_res)) {
                if (method_exists(self::$controller, self::$uri_dispart_path[1])) {
                    self::$method_name = self::$uri_dispart_path[1];
                    unset(self::$uri_dispart_path[1]);
                }
            }
        }

        if (!empty(self::$uri_dispart_path)) {
            preg_match_all("/(?<={)(.*?)(?=})/", self::$route_active, $result);
            $params_key = $result[0];

            preg_match_all("/(?={)(.*?)(?<=})/", self::$route_active, $params_bracket);

            $without_custom_params = self::$route_active;
            foreach ($params_bracket as $param_bracket) {
                $without_custom_params = str_replace($param_bracket, "", $without_custom_params);
            }

            $params_value = explode("/", $without_custom_params);
            $params_value = array_filter($params_value, fn($param_value) => !empty($param_value));

            $params_value = array_diff(self::$uri_dispart_path, $params_value);


            self::$params = array_combine($params_key, array_values($params_value));
        }
    }

    private static function warningPage(string $warning_code) : void {
        self::$controller_name = self::$warning_controller_name;
        self::defineControllerClass();
        call_user_func_array([self::$controller, "code_{$warning_code}"], []);
        die();
    }
    
    private static function isExactCustomUri($uri_paths_custom, $real_uri_paths) : bool {
        $uri_differents = array_diff($uri_paths_custom, $real_uri_paths);

        $is_exact_uri = array_filter($uri_differents, function($diff) use($uri_paths_custom, $real_uri_paths) {
            $diff_index = array_search($diff, $uri_paths_custom);
            
            $custom_uri_param = "/(?={)(.*?)(?<=})/";
            preg_match($custom_uri_param, $diff, $diff_res);

            if (empty($diff_res)) return boolval($diff_index);
            
            return empty($real_uri_paths[$diff_index]);
        });

        return empty($is_exact_uri);
    }

    private static function checkCustomUriPath(string $uri_path_route) : bool {
        self::$uri_paths_custom = explode("/", $uri_path_route);
        self::$real_uri_paths = explode("/", self::$real_uri_path);

        if ($uri_path_route === self::$real_uri_path) return true;
        if ($uri_path_route === "/") return false;

        $is_same_length = count(self::$uri_paths_custom) === count(self::$real_uri_paths);
        return self::isExactCustomUri(self::$uri_paths_custom, self::$real_uri_paths) && $is_same_length;
    }

    private static function requestUriExist(string $uri_path_route) : bool {
        $uri_exist = self::checkCustomUriPath($uri_path_route);
        if ($uri_exist) self::$route_active = $uri_path_route;
        return $uri_exist;
    }

    private static function resuestMethodExist($request_methods) : bool {
        if (is_string($request_methods)) {
            if ($request_methods === "ALL") return true;
            return $request_methods == $_SERVER["REQUEST_METHOD"];
        }

        return boolval(array_filter($request_methods, function($request_method) {
            return $request_method == $_SERVER["REQUEST_METHOD"];
        }));
    }

    private static function requestsHandler() : void {
        foreach (self::$routes as $route_index => $route) {
            $match_uri = self::requestUriExist($route["uri_path"]);
            if (!$match_uri && count(self::$routes) - 1 == $route_index) self::warningPage("404");
            if (!$match_uri) continue;
            $match_method = self::resuestMethodExist($route["request_methods"]);
            if (!$match_method) self::warningPage("405");

            break;
        }
    }

    public static function maintenanceMode() {
        self::$controller_name = self::$maintenance_controller_name;
        self::defineControllerClass();
        call_user_func_array([self::$controller, self::$method_name], self::$params);
        die();
    }

    public static function run() : void {
        if (empty(self::$routes)) self::$routes[] = self::$default_route;

        self::parseURL();
        self::requestsHandler();
        self::checkRedirectAction();
        self::distributeURL();

        call_user_func_array([self::$controller, self::$method_name], self::$params);
    }
}

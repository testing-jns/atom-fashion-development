<?php

use core\Controller;
use middlewares\CookieManager;

class UserController extends Controller {
    public function settings(...$args) {
        $cookie_manager_response = CookieManager::verify();
        if (!$cookie_manager_response["success"]) $this->redirect("/login");

    }


}
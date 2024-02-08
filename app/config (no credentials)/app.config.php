<?php

// We need prefix url, cause we use reverse proxy with apache and the uri is /atom-fashion
// So that, when handling request file css, js, image or others, the program can get it
// define("PREFIX_URL", "/Kelompok_2/atom-fashion");
define("PREFIX_URL", "");

define("ROOT_DIR", "./");
define("PATH_APP", __DIR__ . "/../");
// define("BASE_URL", ($_SERVER["REQUEST_SCHEME"] ?? "http") . "://" . $_SERVER["HTTP_HOST"] . "/");
define("BASE_URL", ($_SERVER["REQUEST_SCHEME"] ?? "http") . "://" . $_SERVER["HTTP_HOST"] . PREFIX_URL . "/");
define("IS_SSL_ON", !empty($_SERVER['HTTPS']));

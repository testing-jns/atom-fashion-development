<?php 

namespace core;

class Controller {
    // protected to public, cause .... yah
    public function model(string $path) : object {
        $model = explode("/", $path);
        $model = end($model);
        require_once PATH_APP . "models/{$path}.model.php";
        return new $model;
    }
    public function view(string $view, array $view_data = []) : void {
        $view_path = PATH_APP . "views/{$view}.view.php";
        if (!file_exists($view_path)) {
            require_once PATH_APP . "views/warning/404.view.php";
            die();
        }

        require_once $view_path;
    }
    
    protected function redirect(string $path) : void {
        header("Location: " . rtrim(BASE_URL, "/") . $path, true, 301);
        die();
    }
}

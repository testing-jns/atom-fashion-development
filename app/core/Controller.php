<?php 

namespace core;

class Controller {
    // protected function model(string $model) : object {
    //     require_once PATH_APP . "models/{$model}.model.php";
    //     return new $model;
    // }
    protected function model(string $path) : object {
        $model = explode("/", $path);
        $model = end($model);
        require_once PATH_APP . "models/{$path}.model.php";
        return new $model;
    }
    protected function view(string $view, array $view_data = []) : void {
        $view_path = PATH_APP . "views/{$view}.view.php";
        if (!file_exists($view_path)) {
            require_once PATH_APP . "views/warning/404.view.php";
            return;
        }

        require_once $view_path;
    }
    
    // protected function redirect(string $path) : void {
    //     header("Location: ./{$path}", true, 301);
    //     die();
    // }
}

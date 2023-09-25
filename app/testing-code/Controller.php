<?php 

namespace core;

class Controller {
    protected function model(string $model) : object {
        require_once PATH_APP . "/models/{$model}.model.php";
        return new $model;
    }
    protected function view(string $view, array $view_data = []) : void {
        require_once PATH_APP . "/views/{$view}.view.php";
    }
}

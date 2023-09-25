<?php 

use core\Controller;

class Warning extends Controller {
    public function code_404() : void {
        $this->view("warning/404");
    }
    public function code_405() : void {
        $this->view("warning/405");
    }
}

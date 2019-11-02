<?php

namespace Framework\App\Controllers;

use Framework\Core\Controller as Controller;

class Login extends Controller {

    public function index() {
        var_dump("login");
        var_dump($this->getContainer());
    }

    public function test() {
        //var_dump($this->getContainer());
        //var_dump($this->getContainer()->get("test"));
    }

    public function register() {
        var_dump("register");
    }
}
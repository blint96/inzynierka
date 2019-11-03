<?php

namespace Framework\App\Controllers;

use Framework\Core\Controller as Controller;
use Framework\Core\View;

class Login extends Controller {

    public function index() {
        var_dump("login");
    }

    public function register() {
        $template = new View('index');

        return $template->set('test', "Testowy tekst")
            ->set('array', ['test1', 'test2', 'test3', 'test4'])
            ->render();


        //var_dump("register");
        //var_dump($this->getContainer()->get("app.router"));
    }
}
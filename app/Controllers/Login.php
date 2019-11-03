<?php

namespace Framework\App\Controllers;

use Framework\Core\Controller as Controller;
use Framework\Core\View;

class Login extends Controller {

    public function index() {
        var_dump("login");
    }

    public function register() {
        View::load_view('index',
            ["array" => ["string1", "string2", "string3"], "string" => "Test stringgg", "int" => 1000]);
    }
}
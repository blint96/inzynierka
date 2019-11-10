<?php

namespace Framework\App\Controllers;

use Framework\App\Models\User;
use Framework\Core\Controller as Controller;
use Framework\Core\View;

class Login extends Controller {

    public function index() {
        var_dump("login");
    }

    public function register() {
        // get the session service $session->variable;
        $session = $this->getContainer()->get('app.session');

        // prepare data
        $userModel = $this->getContainer()->get('model.user');
        $users = $userModel->getAll();
        $user = $userModel->getUser(1);

        var_dump($user);

        // render view
        View::load_view('index',
            ["array" => ["string1", "string2", "string3"], "string" => "Test stringgg", "int" => 1000]);
    }
}
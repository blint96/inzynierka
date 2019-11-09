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
        $mysql = $this->getContainer()->get('driver.mysql');

        if($mysql->connect())
            $mysql->setDatabase("inzynierka");

        $userModel = $this->getContainer()->get('model.user');
        $userModel->test();
        //$userModel = \Framework\Core\Model::factory($this, '\Framework\App\Models\User');
        //$userModel->test();
        //$userModel = $this->getContainer()->get(User::class)->__construct($this->getContainer());
        //$userModel->test();

        View::load_view('index',
            ["array" => ["string1", "string2", "string3"], "string" => "Test stringgg", "int" => 1000]);
    }
}
<?php 

namespace Framework\App\Controllers;

use Framework\Core\Controller as Controller;

class Hello extends Controller {

	public function index() {
	    //var_dump($this->getContainer());
	    var_dump("hello controller");

	    var_dump($this->getContainer()->get("app.router"));
    }
}
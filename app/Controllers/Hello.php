<?php 

namespace Framework\App\Controllers;

use Framework\Core\Controller as Controller;

class Hello extends Controller {

	/*public function __construct() {
		echo "Test kontrolera.";
	}*/

	public function index() {
	    var_dump($this->getContainer());
    }

	public function test() {
		//var_dump($this->getContainer());
		//var_dump($this->getContainer()->get("test"));
	}
}
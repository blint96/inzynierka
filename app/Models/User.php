<?php

namespace Framework\App\Models;

use Framework\Core\Model;

class User extends Model {

    public function test() {
        \var_dump($this->getDb());
    }
}
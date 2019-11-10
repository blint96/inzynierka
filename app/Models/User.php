<?php

namespace Framework\App\Models;

use Framework\Core\Model;

class User extends Model {

    public function test() {
        \var_dump($this->getDb());
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getUser($id) {
        $query = $this->getDb()->select("SELECT * FROM users WHERE id = " . $id);
        return $this->getDb()->fetch($query);
    }

    /**
     * Get all users
     * @return mixed
     */
    public function getAll() {
        $query = $this->getDb()->select("SELECT * FROM users");
        return $this->getDb()->fetchAll($query);
    }
}
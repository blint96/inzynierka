<?php

namespace Framework\Core\DBDrivers;

use Framework\Core\Database;

class SQLiteDriver extends Database implements DatabaseInterface
{
    protected $dbFile;

    public function __construct($dbFile)
    {
        $this->dbFile = 'sqlite:' . $dbFile;
    }

    public function connect()
    {
        $handler = new \PDO($this->dbFile);

        /*$handler->exec(
            "CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY,
    name TEXT,
    surname TEXT)"
        );

        $handler->exec("INSERT INTO users VALUES(1, 'Janusz', 'Kowalski')");*/

        $this->setHandler($handler);
    }

    public function disconnect()
    {
        $this->dbFile = null;
        $this->setHandler(null);
    }

    public function fetch($query, $type = MYSQLI_ASSOC)
    {
        return $query->fetch();
    }

    public function fetchAll($query, $type = MYSQLI_ASSOC)
    {
        $results = [];
        foreach($query as $q) {
            $results[] = $q;
        }
        return $results;
    }

    public function select($sql)
    {
        return $this->getHandler()->query($sql);
    }

    public function insert($sql)
    {
        return $this->getHandler()->query($sql);
    }

    public function delete($sql)
    {
        return $this->getHandler()->query($sql);
    }

    public function update($sql)
    {
        return $this->getHandler()->query($sql);
    }

}
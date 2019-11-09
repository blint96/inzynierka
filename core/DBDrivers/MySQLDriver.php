<?php

namespace Framework\Core\DBDrivers;

use Framework\Core\Database;
use mysql_xdevapi\Exception;

class MySQLDriver extends Database implements DatabaseInterface
{
    protected $mysqlHost;

    protected $mysqlPort;

    protected $mysqlUser;

    protected $mysqlPassword;

    protected $mysqlDatabase;

    /**
     * MySQLDriver constructor.
     * @param $host
     * @param $port
     * @param $user
     * @param $password
     * @param $database
     */
    public function __construct($host, $port, $user, $password, $database) {
        $this->mysqlHost = $host;
        $this->mysqlPort = $port;
        $this->mysqlUser = $user;
        $this->mysqlPassword = $password;
        $this->mysqlDatabase = $database;
    }

    public function isConnected() {
        if($this->getHandler() === null || !($this->getHandler() instanceof \mysqli)) return FALSE;
        else return $this->getHandler()->ping();
    }

    public function connect() {
        try {
            $handler = new \mysqli($this->mysqlHost, $this->mysqlUser, $this->mysqlPassword);
            $this->setHandler($handler);
        } catch (\Exception $e) {
            throw new \Exception("Cannot connect to database, check provided mysql config!");
        }

        return TRUE;
    }

    public function disconnect() {
        if($this->getHandler() !== null && $this->getHandler() instanceof \mysqli)
            $this->getHandler()->close();
    }

    public function select() {
        // TODO: Implement select() method.
    }

    public function insert() {
        // TODO: Implement insert() method.
    }

    public function delete() {
        // TODO: Implement delete() method.
    }

    public function update() {
        // TODO: Implement update() method.
    }

    public function setDatabase($database) {
        if($this->getHandler() !== null) {
            $this->getHandler()->select_db($database);
        }

        $this->mysqlDatabase = $database;
        return $this;
    }
}
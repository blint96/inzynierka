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

    public function fetch($query, $type = MYSQLI_ASSOC) {
        return $query->fetch_array($type);
    }

    public function fetchAll($query, $type = MYSQLI_ASSOC) {
        return $query->fetch_all($type);
    }

    public function query($sql) {
        return $this->getHandler()->query($sql);
    }

    public function select($sql) {
        return $this->query($sql);
    }

    public function insert($sql) {
        return $this->query($sql);
    }

    public function delete($sql) {
        return $this->query($sql);
    }

    public function update($sql) {
        return $this->query($sql);
    }

    public function setDatabase($database) {
        if($this->getHandler() !== null) {
            $this->getHandler()->select_db($database);
        }

        $this->mysqlDatabase = $database;
        return $this;
    }
}
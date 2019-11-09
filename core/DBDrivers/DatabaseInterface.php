<?php


namespace Framework\Core\DBDrivers;

interface DatabaseInterface
{
    /**
     * Establish connection to database
     * @return mixed
     */
    public function connect();

    /**
     * Disconnect from database
     * @return mixed
     */
    public function disconnect();

    /**
     * Select query
     * @return mixed
     */
    public function select();

    /**
     * Insert query
     * @return mixed
     */
    public function insert();

    /**
     * Delete query
     * @return mixed
     */
    public function delete();

    /**
     * Update query
     * @return mixed
     */
    public function update();
}
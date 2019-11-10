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
     * Get single result
     *
     * @param $query
     * @param $type
     * @return mixed
     */
    public function fetch($query, $type);

    /**
     * Get all results as array
     *
     * @param $query
     * @param $type
     * @return mixed
     */
    public function fetchAll($query, $type);

    /**
     * Select query
     * @return mixed
     */
    public function select($sql);

    /**
     * Insert query
     * @return mixed
     */
    public function insert($sql);

    /**
     * Delete query
     * @return mixed
     */
    public function delete($sql);

    /**
     * Update query
     * @return mixed
     */
    public function update($sql);
}
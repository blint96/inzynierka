<?php


namespace Framework\Core;


abstract class Database
{
    private $handler;

    public function setHandler($handler) {
        $this->handler = $handler;
    }

    public function getHandler() {
        return $this->handler;
    }
}
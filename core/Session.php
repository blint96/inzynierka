<?php

namespace Framework\Core;

class Session
{
    /**
     * Flash messages
     * @var array|mixed
     */
    private $flashes = [];

    public function __construct() {
        session_start();

        $this->flashes = isset($_SESSION['__flashes']) ? $_SESSION['__flashes'] : [];
    }

    public function destroy() {
        session_destroy();
    }

    public function __get($name) {
        return (isset($_SESSION[$name]) ? $_SESSION[$name] : null);
    }

    public function __set($name, $value) {
        $_SESSION[$name] = $value;
    }

    public function setFlash($name, $value) {
        $this->flashes[$name] = $value;
        $_SESSION['__flashes'] = $this->flashes;
    }

    public function getFlash($name) {
        if(isset($this->flashes[$name])) {
            $value = $this->flashes[$name];
            unset($this->flashes[$name]);
            $_SESSION['__flashes'] = $this->flashes;
            return $value;
        }

        return NULL;
    }
}
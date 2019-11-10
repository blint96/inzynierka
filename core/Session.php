<?php

namespace Framework\Core;

class Session
{
    public function __construct() {
        session_start();
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
}
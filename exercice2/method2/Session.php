<?php
class Session {
    private $duration; 

    public function __construct($duration = 3600 * 24 * 30) { 
        $this->duration = $duration;
    }

    public function get($key) {
        return $_COOKIE[$key] ?? null;
    }

    public function set($key, $value) {
        setcookie($key, $value, time() + $this->duration, "/");
        $_COOKIE[$key] = $value; 
    }

    public function exists($key) {
        return isset($_COOKIE[$key]);
    }

    public function delete($key) {
        setcookie($key, '', time() - 3600, "/");
        unset($_COOKIE[$key]);
    }

    public function clearAll() {
        foreach ($_COOKIE as $key => $val) {
            $this->delete($key);
        }
    }
}

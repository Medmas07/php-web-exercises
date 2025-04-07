<?php
// Exercise 2 
class Session {
    private $data = []; 
    private $sessionId;

    public function __construct($sessionId) {
        $this->sessionId = $sessionId;
        $this->data["nbVisits"] = 0; 
    }

    public function set($key, $value) {
        $this->data[$key] = $value;
    }

    public function get($key) {
        return isset($this->data[$key]) ? $this->data[$key] : null;
    }

    public function delete($key) {
        if (isset($this->data[$key])) {
            unset($this->data[$key]);
        }
    }

    public function getSessionId() {
        return $this->sessionId;
    }

    public function incrementVisits() {
        if (isset($this->data["nbVisits"])) {
            $this->data["nbVisits"]++;
        } else {
            $this->data["nbVisits"] = 1;
        }
    }

    public function getData() {
        return $this->data; 
    }
}
?>

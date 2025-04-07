<?php
// Exercise 2 
class Session {
    private $data = [];
    private $sessionId;
    private data["nbVisits"] = 0;

    public function __construct($sessionId) {
        $this->sessionId = $sessionId;
    }

    public function set($key, $value) {
        $this->data[$key] = $value;
    }

    public function get($key) {
        return isset($this->data[$key]) ? $this->data[$key] : null;
    }

    public function incrementVisits() {
      if (isset($this->data["nbVisits"])){
        $this->data["nbVisits"]++;
      } else {
        $this->data["nbVisits"] = 1;
      }
    }


}
?>
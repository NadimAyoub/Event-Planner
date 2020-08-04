<?php
class Admin {
    private $username;
    private $password;

    public function __construct($uname, $pwd) {
        $this->username = $uname;
        $this->password = $pwd;
    }
    public function getUsername() { return $this->username; }
    public function getPassword() { return $this->password; }

    public function setUsername($n) { $this->username = $n; }
    public function setPassword($p) { $this->password = $p; }
}
?>

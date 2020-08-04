<?php

require_once 'User.php';

class UserTable {
    private $link;
    
    public function __construct($pdo) {
        $this->link = $pdo;
    }


    public function getUserByUsername($username) {
        $sql = "SELECT * FROM users WHERE username = :username";
        $params = array('username' => $username);
        $stmt = $this->link->prepare($sql);
        $status = $stmt->execute($params);
        if ($status != true) {
            $errorInfo = $stmt->errorInfo();
            throw new Exception("Could not retrieve user: " . $errorInfo[2]);
        }

        $user = null;
        if ($stmt->rowCount() == 1) {
            $row = $stmt->fetch();
            $pwd = $row['password'];
            $user = new User($username, $pwd);
        }
        return $user;
    }
    public function getVerifyByUsername($username) {
        $sql = "SELECT * FROM verify WHERE username = :username";
        $params = array('username' => $username);
        $stmt = $this->link->prepare($sql);
        $status = $stmt->execute($params);
        if ($status != true) {
            $errorInfo = $stmt->errorInfo();
            throw new Exception("Could not retrieve user: " . $errorInfo[2]);
        }

        $verify = null;
        if ($stmt->rowCount() == 1) {
            $row = $stmt->fetch();
            $pwd = $row['password'];
            $verify = new User($username, $pwd);
        }
        return $verify;
    }

}

?>

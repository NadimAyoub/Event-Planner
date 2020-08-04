<?php

require_once 'Admin.php';

class AdminTable {
    private $link;
    
    public function __construct($pdo) {
        $this->link = $pdo;
        $this->connect = $pdo;
    }

    public function getVerifyById($id) {
        $sqlQuery = "SELECT * FROM verify inner join roles on verify.RoleID = roles.RoleID WHERE VerifyID = :id";
        
        $statement = $this->connect->prepare($sqlQuery);
        $params = array(
            "id" => $id
        );
        
        $status = $statement->execute($params);
        
        if (!$status) {
            die("Could not retrieve user ID");
        }
        
        return $statement;
    }
    public function getUserById($id) {
        $sql = "SELECT * FROM admins WHERE id = :id";
        $params = array('id' => $id);
        $stmt = $this->link->prepare($sql);
        $status = $stmt->execute($params);
        if ($status != true) {
            $errorInfo = $stmt->errorInfo();
            throw new Exception("Could not retrieve user: " . $errorInfo[2]);
        }

        $user = null;
        if ($stmt->rowCount() == 1) {
            $row = $stmt->fetch();
            $username = $row['username'];
            $pwd = $row['password'];
            $user = new Admin($username, $pwd);
        }
        return $user;
    }

    public function getUserByUsername($username) {
        $sql = "SELECT * FROM admins WHERE username = :username";
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
            $user = new Admin($username, $pwd);
        }
        return $user;
    }

    public function getAdmins() {
        $sql = "SELECT * FROM admins";
        $stmt = $this->link->prepare($sql);
        $status = $stmt->execute();
        if ($status != true) {
            $errorInfo = $stmt->errorInfo();
            throw new Exception("Could not retrieve admins: " . $errorInfo[2]);
        }

        $users = array();
        $row = $stmt->fetch();
        while ($row != null) {
            $username = $row['username'];
            $pwd = $row['password'];
            $user = new Admin($username, $pwd);
            $users[$id] = $user;

            $row = $stmt->fetch();
        }
        return $users;
    }
    
}

?>

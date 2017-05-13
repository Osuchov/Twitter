<?php

class User {
    private $id;
    private $username;
    private $hashPass;
    private $email;
    private $status;
    
    static public function loadUserById(mysqli $connection, $id) {
        $sql = "SELECT * FROM Users WHERE id=$id";
        $result = $connection->query($sql);
        
        if ($result==true && $result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $loadedUser = new User();
            $loadedUser->id = $row['id'];
            $loadedUser->username = $row['username'];
            $loadedUser->hashPass = $row['hashPass'];
            $loadedUser->email = $row['email'];
            $loadedUser->status = $row['status'];
        }
    }
    
    public function __construct() {
        $this->id = -1;
        $this->username = '';
        $this->hashPass = '';
        $this->email = '';
        $this->status = '1';
    }
    
    public function getUsername() {
        return $this->username;
    }
    public function getHashPass() {
        return $this->hashPass;
    }
    public function getEmail() {
        return $this->email;
    }
    public function getStatus() {
        return $this->status;
    }
    
    public function setUsername($name) {
        $this->username = $name;
    }
    public function setHashPass($hashPass) {
        $this->hashPass = $hashPass;
    }    
    public function setEmail($email) {
        $this->email = $email;
    }
    public function setStatus($status) {
        $this->status = $status;
    }
    

}

?>
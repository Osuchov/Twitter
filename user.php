<?php

class User {
    private $id;
    private $username;
    private $hashPass;
    private $email;
    private $status;
    
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
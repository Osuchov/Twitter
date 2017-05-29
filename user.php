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
            return $loadedUser;
        }
        return null;
    }
    
    static public function loadUserByEmail(mysqli $connection, $email) {
        $sql = "SELECT * FROM Users WHERE email='$email'";
        $result = $connection->query($sql);
        
        if ($result==true && $result->num_rows != 0) {
            $row = $result->fetch_assoc();
            $loadedUser = new User();
            $loadedUser->id = $row['id'];
            $loadedUser->username = $row['username'];
            $loadedUser->hashPass = $row['hashPass'];
            $loadedUser->email = $row['email'];
            $loadedUser->status = $row['status'];
            return $loadedUser;
        }
        echo 'Incorrect e-mail.<br>';
        return null;        
    }
    
    static public function loadAllUsers(mysqli $connection){
        $sql = "SELECT * FROM Users";
        $users = array();
        $result = $connection->query($sql);
        if($result == true && $result->num_rows != 0){
            foreach($result as $row){
                $loadedUser = new User();
                $loadedUser->id = $row['id'];
                $loadedUser->username = $row['username'];
                $loadedUser->hashedPassword = $row['hashPass'];
                $loadedUser->email = $row['email'];
                $users[] = $loadedUser;
            }
        }
        return $users;
    }
    
    public function __construct() {
        $this->id = -1;
        $this->username = '';
        $this->hashPass = '';
        $this->email = '';
        $this->status = '1';
    }
    
    public function saveToDB($connection){
        if($this->id==-1){
            $sql = "INSERT INTO Users (username, email, hashPass, status) VALUES ('$this->username', '$this->email', '$this->hashPass', '$this->status')";

            $result = $connection->query($sql);
            if($result == true){
                $this->id = $connection->insert_id;
                echo 'Well done! You\'ve succesfully added user '.$this->username.' to the database.<br>';
                echo 'Use your e-mail in login panel and login.<br>';
                return true;
            }
            else {
                $query = "SELECT * FROM Users WHERE email='$this->email'";
                $result2 = $connection->query($query);
                if ($result2->num_rows != 0) {
                    echo 'We\'re sorry, but e-mail '.$this->email.' is already in use.<br>';
                    echo 'Try a different one.<br>';
                    return false;                    
                }

            }
        }
        else {
            $sql = "
                UPDATE Users SET
                    username='$this->username',
                    email='$this->email',
                    hashPass='$this->hashPass'
                WHERE
                    id=$this->id";
            $result = $connection->query($sql);
            if($result == true){
                echo 'Well done! You\'ve successfully modified user '.$this->username.' in the database.<br>';
                return true;
            }
        }
    }
    
    public function getUserid() {
        return $this->id;
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
    
    public function PrintInfo() {
        echo 'Username: '.$this->username.'<br>'.
             'e-mail: '.$this->email.'<br>'.
             'hashed password: '.$this->hashPass.'<br>'.
             'status: '.$this->status.'<br>'.
             'id: '.$this->id.'<br>';
    }
}
?>
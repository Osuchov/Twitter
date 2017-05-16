<?php

class Tweet {
    private $id;
    private $userid;
    private $creationDate;
    private $text;
    
    static public function loadTweetById($connection, $id) {
        $sql = "SELECT * FROM Tweets WHERE id=$id";
        $result = $connection->query($sql);
        
        if ($result==true && $result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $loadedTweet = new Tweet();
            $loadedTweet->id = $row['id'];
            $loadedTweet->userid = $row['userid'];
            $loadedTweet->creationDate = $row['creationDate'];
            $loadedTweet->text = $row['text'];
            return $loadedTweet;
        }
        return null;        
    }
    
    static public function loadTweetsByUserId ($connection, $userId) {
        $sql = "SELECT * FROM Tweets WHERE userid=$userId";
        $result = $connection->query($sql);
        
        if ($result==TRUE && $result->num_rows !=0) {
            $row = $result->fetch_assoc();
            $loadedTweet = new Tweet();
            $loadedTweet->id = $row['id'];
            $loadedTweet->userid = $row['userid'];
            $loadedTweet->creationDate = $row['creationDate'];
            $loadedTweet->text = $row['text'];
            return $loadedTweet;
        }
        echo 'Incorrect User.<br>';
        return null;
    }
    
    public function __construct() {
        $this->$id= -1;
        $this->userid = '';
        $this->creationDate = '';
        $this->text = '';
    }
    
    public function getId() {
        return $this->id;
    }
    public function getUserId() {
        return $this->userid;
    }
    public function getCreationDate() {
        return $this->creationDate;
    }
    public function getText() {
        return $this->text;
    }
    
    public function setUserId() {
        
    }
    public function setCreationDate() {
        
    }
    public function setText() {
        
    }
    
    public function PrintInfo() {
        echo 'ID: '.$this->id.'<br>'.
             'User ID: '.$this->userid.'<br>'.
             'Creation date: '.$this->creationDate.'<br>'.
             'Text: '.$this->text.'<br>';        
    }
}
?>
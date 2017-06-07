<?php
require_once './user.php';
require_once './db_conn.php';

class Tweet {
    protected $id;
    protected $userid;
    protected $creationDate;
    protected $text;
    
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
        $tweets = [];
        $result = $connection->query($sql);
        
        if ($result==TRUE && $result->num_rows !=0) {
            foreach ($result as $row) {
                $loadedTweet = new Tweet();
                $loadedTweet->id = $row['id'];
                $loadedTweet->userid = $row['userid'];
                $loadedTweet->creationDate = $row['creationDate'];
                $loadedTweet->text = $row['text'];
                $tweets[] = $loadedTweet;                
            }
        }
        return $tweets;
    }
    
    static public function loadAllTweets (mysqli $connection) {
        $sql = "SELECT * FROM Tweets";
        $tweets = [];
        $result = $connection->query($sql);
        if ($result == true && $result->num_rows !=0) {
            foreach ($result as $row) {
                $loadedTweet = new Tweet();
                $loadedTweet->id = $row['id'];
                $loadedTweet->userid = $row['userid'];
                $loadedTweet->creationDate = $row['creationDate'];
                $loadedTweet->text = $row['text'];
                $tweets[] = $loadedTweet;
            }
        }
        return $tweets;
    }
    
    public function __construct() {
        $this->id= -1;
        $this->userid = '';
        $this->creationDate = '';
        $this->text = '';
    }
    
    public function saveToDB($connection) {
        if($this->id== -1) {
            $sql = "INSERT INTO Tweets (userid, creationDate, text) VALUES ('$this->userid', NOW(), '$this->text')";
            
            $result = $connection->query($sql);
            if ($result == true) {
                $this->id = $connection->insert_id;
                return true;
            }
            else {
                return false;
            }
        }
        else {
            $sql = "
                UPDATE Tweets SET
                    usserid='$this->userid',
                    creationDate=NOW(),
                    text='$this->text'
                WHERE
                    id=$this->id";
            $result = $connection->query($sql);
            if($result == true){
                return true;
            }
        }        
    }
    
    public function tweetUserEmail($connection) {
        $tweetuserid = $this->userid;
        $sql = 'SELECT email FROM Users where id ='.$tweetuserid;
        $result = $connection->query($sql);
        $row = $result->fetch_assoc();
        $email = $row['email'];
        return $email;
    }
    
    public function tweetUserName($connection) {
        $tweetuserid = $this->userid;
        $sql = 'SELECT username FROM Users where id ='.$tweetuserid;
        $result = $connection->query($sql);
        $row = $result->fetch_assoc();
        $name = $row['username'];
        return $name;
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
    
    public function setUserId($id) {
        if (is_numeric($id)) {
            $this->userid = $id;
        }
    }
    public function setCreationDate() {
        $this->creationDate = strtotime("now");
    }
    public function setText($text) {
        if (is_string($text)) {
            $this->text = $text;
        }
    }    
    
    public function PrintInfo() {
        echo $this->creationDate.' '.$this->username.' wrote: '.
             '"'.$this->text.'"<br><br>';
//        echo 'ID: '.$this->id.' '.
//             'User ID: '.$this->userid.'; '.
//             'User '.$this->username.'; '.
//             'Creation date: '.$this->creationDate.'; '.
//             'Text: '.$this->text.'<br>';        
    }
}

?>
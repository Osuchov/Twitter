<?php
require_once './tweet.php';

class Comment extends Tweet {
    private $tweetid;
    
    static public function loadCommentById($connection, $id) {
        $sql = "SELECT * FROM Comments WHERE id=$id";
        $result = $connection->query($sql);
        
        if ($result==true && $result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $loadedComment = new Comment();
            $loadedComment->id = $row['id'];
            $loadedComment->userid = $row['userid'];
            $loadedComment->tweetid = $row['tweetid'];
            $loadedComment->creationDate = $row['creationDate'];
            $loadedComment->text = $row['text'];
            return $loadedComment;
        }
        return null;        
    }    

    static public function loadCommentsByTweetId ($connection, $tweetid) {
        $sql = "SELECT * FROM Comments WHERE tweetId=$tweetid";
        $comments = [];
        $result = $connection->query($sql);
        
        if ($result==TRUE && $result->num_rows !=0) {
            foreach ($result as $row) {
                $loadedComment = new Comment();
                $loadedComment->id = $row['id'];
                $loadedComment->userid = $row['userid'];
                $loadedComment->creationDate = $row['creationDate'];
                $loadedComment->text = $row['text'];
                $comments[] = $loadedComment;                
            }
        }
        return $comments;
    }
    
    static public function loadCommentsByUserId ($connection, $userId) {
        $sql = "SELECT * FROM Comments WHERE userId=$userId";
        $comments = [];
        $result = $connection->query($sql);
        
        if ($result==TRUE && $result->num_rows !=0) {
            foreach ($result as $row) {
                $loadedComment = new Comment();
                $loadedComment->id = $row['id'];
                $loadedComment->userid = $row['userid'];
                $loadedComment->creationDate = $row['creationDate'];
                $loadedComment->text = $row['text'];
                $comments[] = $loadedComment;                
            }
        }
        return $comments;
    }
    
    public function __construct() {
        parent::__construct();
        $this->tweetid = '';
    }    
    
    public function saveToDB($connection) {
        if($this->id== -1) {
            $sql = "INSERT INTO Comments (userid, tweetid, creationDate, text) VALUES ($this->userid, $this->tweetid, NOW(), '$this->text')";
            
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
                UPDATE Comments SET
                    usserid='$this->userid',
                    tweetid='$this->tweetid',
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

    public function commentUserEmail($connection) {
        $commentuserid = $this->userid;
        $sql = 'SELECT email FROM Users where id ='.$commentuserid;
        $result = $connection->query($sql);
        $row = $result->fetch_assoc();
        $email = $row['email'];
        return $email;
    }
    
    public function CommentUserName($connection) {
        $commentuserid = $this->userid;
        $sql = 'SELECT username FROM Users where id ='.$commentuserid;
        $result = $connection->query($sql);
        $row = $result->fetch_assoc();
        $name = $row['username'];
        return $name;
    }
    
    public function getTweetId() {
        return $this->tweetid;
    }  

    public function setTweetId($id) {
        if (is_numeric($id)) {
            $this->tweetid = $id;
        }
    }  

    public function PrintInfo() {
        echo $this->creationDate.' '.$this->username.' commented tweet: '.$this->tweetid.' with: "'.$this->text.'"<br><br>';    
    }    
}

?>
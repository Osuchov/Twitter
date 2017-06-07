<?php

class Message {
    private $id;
    private $author_id;
    private $receiver_id;
    private $creationDate;
    private $text;
    private $status;
    
    static public function loadMessagesByAuthor (mysqli $connection, $id) {
        $sql = "SELECT * FROM Messages WHERE author_id = $id";
        $messages = [];
        $result = $connection->query($sql);
        
        if ($result==true && $result->num_rows > 0) {
            foreach ($result as $row) {
                $loadedMessage = new Message();
                $loadedMessage->id = $row['id'];
                $loadedMessage->author_id = $row['author_id'];
                $loadedMessage->receiver_id = $row['receiver_id'];
                $loadedMessage->creationDate = $row['creationDate'];
                $loadedMessage->text = $row['text'];
                $loadedMessage->status = $row['status'];
                $messages[] = $loadedMessage;
            }
        }
        return $messages;      
    }
    
    static public function loadMessagesByReceiver (mysqli $connection, $id) {
        $sql = "SELECT * FROM Messages WHERE receiver_id= $id";
        $messages = [];
        $result = $connection->query($sql);
        
        if ($result==true && $result->num_rows > 0) {
            foreach ($result as $row) {
                $loadedMessage = new Message();
                $loadedMessage->id = $row['id'];
                $loadedMessage->author_id = $row['author_id'];
                $loadedMessage->receiver_id = $row['receiver_id'];
                $loadedMessage->creationDate = $row['creationDate'];
                $loadedMessage->text = $row['text'];
                $loadedMessage->status = $row['status'];
                $messages[] = $loadedMessage;
            }
        }
        return $messages;
    }
    
    public function __construct() {
        $this->id = -1;
        $this->author_id = '';
        $this->receiver_id = '';
        $this->creationDate = '';
        $this->text = '';
        $this->status = '6';
    }
    
    public function saveToDB ($connection) {
        if($this->id== -1) {
            $sql = "INSERT INTO Messages (author_id, receiver_id, creationDate, text, status) VALUES ('$this->author_id', '$this->receiver_id', NOW(), '$this->text', '$this->status')";          
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
                UPDATE Messages SET
                    author_id='$this->author_id',
                    receiver_id='$this->receiver_id',
                    creationDate=NOW(),
                    text='$this->text',
                    status='$this->status
                WHERE
                    id=$this->id";
            $result = $connection->query($sql);
            if($result == true){
                return true;
            }
        }           
    }
    
    public function messageAuthorName ($connection) {
        $messageAuthorid = $this->author_id;
        $sql = 'SELECT username FROM Users WHERE id ='.$messageAuthorid;
        $result = $connection->query($sql);
        $row = $result->fetch_assoc();
        $name = $row['username'];
        return $name;        
    }
    public function messageAuthorEmail ($connection) {
        $messageAuthorid = $this->author_id;        
        $sql = 'SELECT email FROM Users WHERE id ='.$messageAuthorid;
        $result = $connection->query($sql);
        $row = $result->fetch_assoc();
        $email = $row['email'];
        return $email;        
    }    
    public function messageReceiverName ($connection) {
        $messageReceiverid = $this->receiver_id;        
        $sql = 'SELECT username FROM Users WHERE id ='.$messageReceiverid;
        $result = $connection->query($sql);
        $row = $result->fetch_assoc();
        $name = $row['username'];
        return $name;         
    }
    public function messageReceiverEmail ($connection) {
        $messageReceiverid = $this->receiver_id;        
        $sql = 'SELECT email FROM Users WHERE id ='.$messageReceiverid;
        $result = $connection->query($sql);
        $row = $result->fetch_assoc();
        $email = $row['email'];
        return $email;        
    }     
    
    public function getMessageStatus($connection) {
        $messageid = $this->id;        
        $sql = 'SELECT s.status_text FROM Statuses s
                JOIN Messages m ON m.status = s.id
                WHERE m.id ='.$messageid;
        $result = $connection->query($sql);
        $row = $result->fetch_assoc();
        $status = $row['status_text'];
        return $status;        
    }
    public function setMessageStatus($connection) {
        if($this->id >= 1) {
            $sql = "UPDATE Messages SET status=$this->status WHERE id=$this->id";
            $result = $connection->query($sql);
        }
        if($result == true){
            return true;        
        }
    }
    
    public function getId() {
        return $this->id;
    }
    public function getAuthorId() {
        return $this->author_id;
    }
    public function getReceiverId() {
        return $this->receiver_id;
    }
    public function getCreationDate() {
        return $this->creationDate;
    }
    public function getText() {
        return $this->text;
    }
    public function getStatus() {
        return $this->status;
    }
    
    public function setAuthorId($id) {
        if (is_numeric($id)) {
            $this->author_id = $id;
        }
    }
    public function setReceiverId($id) {
        if (is_numeric($id)) {
            $this->receiver_id = $id;
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
    public function setStatus($status) {
        if (is_numeric($status)) {
            $this->status = $status;
        }
    }
    
    public function PrintInfo() {
        echo 'ID: '.$this->id. '; '.$this->author_id.' wrote "'.$this->text.'" to '.$this->receiver_id.' and it\'s status is: '.$this->status.'<br><br>';
    }
}
?>
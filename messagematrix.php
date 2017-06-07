<?php
require_once './user.php';
require_once './message.php';

if (isset($_SESSION['useremail'])) {
    $email = $_SESSION['useremail'];
    $userid = $_SESSION['userid'];
}

$allUsers = User:: loadAllUsers($conn);
?>

<html>
    Write your private message here!<br><br>
    <form action="" method="post" role="form">
        <div id="tweet">Send a message! Pick your receiver below:<br>
            <textarea id="tweet" name="messagetext" rows="3" cols="50" maxlength="140" wrap="soft"></textarea><br>
            <select name="receiver" style="font-size: 16px; width: 100%" >
            <?php
            echo '<option selected disabled>Pick your receiver</option>';
            for ($i = 0; $i < count($allUsers); $i++) {         //show all users
                if ($allUsers[$i]->getUserid() !== $userid) {   //without currently logged user
                echo '<option value="'.$allUsers[$i]->getUserid().'">'.$allUsers[$i]->getUsername().' ('.$allUsers[$i]->getEmail().')</option>';
                }
            }
            ?>
            </select><br><br>
            <button type="submit" style="width: 50%">Send your message!</button>
        </div>
    </form>
        <form action="" method="post">
            <div id="tweet" style="width: 50%">Check your inbox or sent messages:<br><br>
            <button style="width: 49%" style="float: left" type="submit" name="page" value="inbox">Inbox</button>
            <button style="width: 49%" style="float: right" type="submit" name="page" value="outbox">Outbox</button>
            </div>
        </form>    
</html>
<?php
if (isset($_POST['messagetext']) && is_string($_POST['messagetext'])) {
    if (strlen($_POST['messagetext']) <= 0 || !isset($_POST['receiver'])) {
        if (strlen($_POST['messagetext']) <= 0) {
            echo 'Your message is too short.<br>';
        } else {
            echo 'Please pick your receiver.<br>';
        }
    }
    else {
        $messagetext = $_POST['messagetext'];
        $receiver = $_POST['receiver'];

        $message = new Message();
        $message->setAuthorId($userid);
        $message->setReceiverId($receiver);
        $message->setCreationDate(date("Y-m-d H:i:s"));
        $message->setText($messagetext);
        $message->saveToDB($conn);
    }
}

if (isset($_POST['page']) && $_POST['page'] === 'inbox') {
    echo 'This is your inbox:<br>';

    $myMessages = Message::loadMessagesByReceiver($conn, $userid);
    if (count($myMessages) == 0) {
        echo 'You received no messages yet.';
    } else {
        $mMRev = array_reverse($myMessages);

        echo '<table id="tweets">';
        foreach ($mMRev as $message) {
            echo '<tr>
                    <td><br><fieldset><legend>Status: <b>' . $message->getMessageStatus($conn) . '</b> From: <b>' . $message->messageAuthorName($conn) . '</b> (' . $message->messageAuthorEmail($conn) . ') <i>' . $message->getCreationDate() . '</i></legend>' . $message->getText() . '</fieldset></td>
                  </tr>';
            $message->setStatus(5);
            $message->setMessageStatus($conn);
        }
        echo '</div></table>';
    }
}
if (isset($_POST['page']) && $_POST['page'] === 'outbox') {
    echo 'This is your outbox:<br>';

    $myMessages = Message::loadMessagesByAuthor($conn, $userid);
    if (count($myMessages) == 0) {
        echo 'You sent no messages yet.';
    } else {
        $mMRev = array_reverse($myMessages);

        echo '<table id="tweets">';
        foreach ($mMRev as $message) {
            echo '<tr>
                    <td><br><fieldset><legend>Status: <b>' . $message->getMessageStatus($conn) . '</b> Sent to: <b>' . $message->messageReceiverName($conn) . '</b> (' . $message->messageReceiverEmail($conn) . ') <i>' . $message->getCreationDate() . '</i></legend>' . $message->getText() . '</fieldset></td>
                  </tr>';
        }
        echo '</div></table>';
    }
}
?>
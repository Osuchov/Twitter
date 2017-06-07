<?php
require_once './user.php';
require_once './tweet.php';
require_once './comment.php';

if (isset($_SESSION['useremail'])) {
    $email = $_SESSION['useremail'];
    $userid = $_SESSION['userid'];
}
?>

<html>
    Find all the newest tweets right here!<br><br>
    <form action="" method="post" role="form">
        <div id="tweet" style="align-content: left">Start tweeting! (tweets are between 1 and 140 characters long)<br>
            <textarea id="tweet" name="tweettext" rows="3" cols="50" maxlength="140" wrap="soft"></textarea><br><br>
            <button type="submit" name="tweet" style="width: 50%">Post your tweet!</button>
        </div>
    </form>
</html>

<?php
if (isset($_POST['tweettext']) && is_string($_POST['tweettext'])) {
    if (strlen($_POST['tweettext']) > 0) {
        $tweettext = $_POST['tweettext'];

        $tweet = new Tweet();
        $tweet->setUserId($userid);
        $tweet->setCreationDate(date("Y-m-d H:i:s"));
        $tweet->setText($tweettext);
        $tweet->saveToDB($conn);
    }
    else {
        echo 'Your tweet is too short.<br>';
    }
}


if (isset($_POST['tweetcomment']) && is_string($_POST['tweetcomment']) &&
        isset($_POST['tweetid']) && is_numeric($_POST['tweetid'])) {
    if (strlen($_POST['tweetcomment']) > 0) {
        echo ' OK !!!';
        $commenttext = $_POST['tweetcomment'];
        $tweetid = intval($_POST['tweetid']);

        $comment = new Comment();
        $comment->setUserId(intval($userid));
        $comment->setTweetId(intval($tweetid));
        $comment->setCreationDate(date("Y-m-d H:i:s"));
        $comment->setText($commenttext);
        $comment->saveToDB($conn);
    }
    else {
        echo 'Your comment is too short.<br>';
    }
}

$alltweets = Tweet::loadAllTweets($conn);
$atRev = array_reverse($alltweets);



echo '<table id="tweets">';
foreach ($atRev as $tweet) {
    echo '<tr>
            <td><br><fieldset><legend><b>'.$tweet->tweetUserName($conn).'</b> ('.$tweet->tweetUserEmail($conn).') <i>'.$tweet->getCreationDate().'</i></legend>'.$tweet->getText().'</fieldset></td>
          </tr>';
    echo '<tr>
            <td><div id="commentpanel">
                    <form action="" method="post" role="form">
                    Comment this tweet:
                            <textarea id="comment" name="tweetcomment" maxlength="140" wrap="soft"></textarea>
                            <input type="hidden" name="tweetid" value="'.$tweet->getId().'" />
                            <button type="submit" name="send">Comment</button>
                    </form>
                </div>
            </td>
         </tr>';
    echo '<div>';
    $allcomments = comment:: loadCommentsByTweetId($conn, $tweet->getId());
    $acRev = array_reverse($allcomments);
    foreach ($acRev as $comment) {
        $commentUser = User:: loadUserById($conn, $comment->getUserId());
        echo '<tr>';
        echo '<td><b>'.$commentUser->getUsername().'</b> ('.$commentUser->getEmail().') sent a comment <i>'.$comment->getCreationDate().'</i><br>'.$comment->getText().'</td>';
        echo '</tr>';
    }
    echo '</div>';
}


echo '</table>';
?>


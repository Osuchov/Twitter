<?php
require_once './user.php';
require_once './tweet.php';

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $userid = $_SESSION['userid'];
}
?>

<html>
    <form action="" method="post" role="form">
        <div id="tweet" style="align-content: left">Start tweeting! (make sure your tweet is between 1 and 140 characters long)<br>
            <textarea id="tweet" name="tweettext" rows="3" cols="50" maxlength="140" wrap="soft"></textarea><br>
            <button type="submit" name="tweet">Post your tweet!</button>
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

$alltweets = Tweet::loadAllTweets($conn);

foreach ($alltweets as $tweet) {
    echo $tweet->PrintInfo();
}

?>
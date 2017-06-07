<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Twitter Application</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>

<?php
echo '<div class="logged" style="width: 15%">Logged as: <b>';
if (!isset($_SESSION['username'])) {
    echo 'not logged in</b>.<br>';
        echo '<form action="" method="get">
            <button style="width: 50%; float: left" type="submit" name="page" value="login">Login</button>
            <button style="width: 50%" style="float: right;" type="submit" name="page" value="registration">Register</button>
            </form>';
}
else {
    echo $_SESSION['username'].'</b><br>';
        echo '<form action="" method="get">
            <button style="width: 50%" type="submit" name="page" value="logout">Logout</button>';
            if (isset($_GET['page']) && $_GET['page']==='profile') {
                echo '<button style="width: 50%" style="float: right;" type="submit" value="">Tweets</button>';
            }
            else{
                echo '<button style="width: 50%" style="float: right;" type="submit" name="page" value="profile">Profile</button>';
            }
        echo '<br><hr>';
        if (isset($_GET['page']) && $_GET['page']==='messages') {
            echo '<button style="width: 100%" style="float: right;" type="submit" value="">Tweets</button>';            
        }
        else {
            echo '<button style="width: 100%" type="submit" name="page" value="messages">Messages</button>';            
        }

        echo '</form>';
    
}
echo '</div>';
?>

</body>
</html>
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
echo '<div class="logged">Logged as: <b>';
if (!isset($_SESSION['username'])) {
    echo 'not logged in</b>.<br>';
        echo '<form action="" method="get">
            <button type="submit" name="page" value="login">Login</button>
            <button style="float: right;" type="submit" name="page" value="registration">Register</button>
            </form>';
}
else {
    echo $_SESSION['username'].'</b><br>';
        echo '<form action="" method="get">
            <button type="submit" name="page" value="logout">Logout</button>
            <button style="float: right;" type="submit" name="page" value="profile">Profile</button>
            </form>';
    
}
echo '</div>';
?>

</body>
</html>
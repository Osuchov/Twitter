<?php
    require_once './config.php';
    session_start();
    
    //$_SESSION['username']= '';
    
    require_once './db_conn.php';
    require_once './header.php';
    require_once './user.php';


echo '<div id="header">Welcome to My Twitter App!<br><br>';

if (!isset($_SESSION['username'])){
    echo 'To view tweets you must be logged in.<br><br>';
}
else {
    echo 'Find all the newest tweets right here!<br><br>';
}


if (isset($_GET['page']) && $_GET['page']==='login') {
    include'./login.php';
}
if (isset($_GET['page']) && $_GET['page']==='registration') {
    include './register.php';
}

echo '</div>';






    require_once './footer.php';
    //unset($_SESSION['username']);
?>

<!--
//    $newUser = new User();
//    $newUser->setUsername('newUser');
//    $newUser->saveToDB($mysqli)
-->
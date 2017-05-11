<?php
    require_once './config.php';
    require_once './db_conn.php';

    session_start();
    var_dump($_SESSION);

    require_once './header.php';
    
//    $newUser = new User();
//    $newUser->setUsername('newUser');
//    $newUser->saveToDB($mysqli);

    echo 'Start';
    require_once 'footer.php';
    
    //unset($_SESSION);
?>
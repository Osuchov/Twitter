<?php
    require_once './config.php';

    session_start();

    require_once './header.php';
    
//    $newUser = new User();
//    $newUser->setUsername('newUser');
//    $newUser->saveToDB($mysqli);

    echo 'Start';
    require_once 'footer.php';
    
    //unset($_SESSION);
?>
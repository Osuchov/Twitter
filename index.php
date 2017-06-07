<?php
    require_once './config.php';    //definition of connection globals
    session_start();
    
    //$_SESSION['username']= '';
    
    require_once './db_conn.php';   //connection with database
    require_once './header.php';    //header of the page
    require_once './user.php';      //user class definitions
    require_once './tweet.php';     //tweet class definitions
    require_once './comment.php';   //comment class definitions
    require_once './message.php';

echo '<br><br>';
echo '<div id="header">Welcome to My Twitter App!<br><br>'; //welcoming

if (isset($_GET['page']) && $_GET['page']==='logout') { //if logout - end session
    unset($_SESSION['username']);
    unset($_SESSION['useremail']);
    unset($_SESSION['userid']);
    header('refresh: 1; index.php');
}

if (!isset($_SESSION['username'])){ //if logged condition
    echo 'To view tweets you must be logged in.<br><br>';
}
else {

    
    if (isset($_GET['page']) && $_GET['page']==='profile') {
        include './profile.php';                           //with profile button go to profile
    }
    elseif (isset($_GET['page']) && $_GET['page']==='messages') {
        include './messagematrix.php';                           //with profile button go to profile
    }
    else {
        require_once './tweetmatrix.php';    //webpage with all tweets
    }
}

if (isset($_GET['page']) && $_GET['page']==='login') {
    include'./login.php';           //if login panel used - go to login page
}
if (isset($_GET['page']) && $_GET['page']==='registration') {
    include './register.php';       //if registration panel used - go to registration page
}

echo '</div>';

    require_once './footer.php';                        //add footer
    //unset($_SESSION['username']);
?>
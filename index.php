<?php
    require_once './config.php';
    session_start();
    
    require_once './db_conn.php';
    require_once './header.php';
//    $newUser = new User();
//    $newUser->setUsername('newUser');
//    $newUser->saveToDB($mysqli)
?>
<div id="header">Welcome to My Twitter App!<br>
    To view tweets you must be logged in.</div>
<br><br>
<div id="loginpanel">
    <form action="index.php" method="POST" role="form">
        <legend>Login panel</legend><br>
        <div>
            <label for="email">E-mail:</label><br>
            <input type="text" name="email"><br>
            <label>Password:</label><br>
            <input type="password"name="pass"><br><br>
            <button type="submit" name="login">Login</button>         
            <button type="submit" name="register">Register</button>
        </div>
    </form>
</div>
</body>

<?php
    require_once './footer.php';
    //unset($_SESSION);
?>
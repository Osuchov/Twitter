<?php
    require_once './config.php';
    session_start();
    
    require_once './db_conn.php';
    require_once './header.php';
    
//    $newUser = new User();
//    $newUser->setUsername('newUser');
//    $newUser->saveToDB($mysqli)
?>
<h1 style="text-align: center">Welcome to My Twitter App</h1>
<h2 style="text-align: center">To view tweets you must be logged in.</h2>
<br><br>
<div class="container">
    <div class="row">
        <form action="index.php" method="POST" role="form">
            <legend>Login panel</legend>
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="text" style="width: 25%; height: 25px" class="form-control" name="email">
                <label>Password:</label>
                <br>
                <input type="password" style="width: 25%; height: 25px" name="pass">
                <br><br>
                <button type="submit" name="login" class="btn btn-primary">Login</button>         
                <button type="submit" name="register" class="btn btn-primary">Register</button>
            </div>
        </form>
    </div>
</div>
</body>

<?php
    require_once './footer.php';
    //unset($_SESSION);
?>
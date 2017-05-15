<?php
require_once './user.php';

echo '<div id="loginpanel"><br>';
    echo '<form action="" method="post" role="form">
            <legend>Registration panel</legend><br>
            <div>
                <label for="email">E-mail:</label><br>
                <input type="text" name="email"><br>
                <label for="email">Username:</label><br>
                <input type="text" name="username"><br>
                <label>Password:</label><br>
                <input type="password" name="pass1"><br>
                <label>Re-enter password:</label><br>
                <input type="password" name="pass2"><br><br>
                <button type="submit" name="register">Register</button>
            </div>
        </form>';

if ($_SERVER['REQUEST_METHOD']==='POST') {

    if (!empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['pass1']) && !empty($_POST['pass2'])) {

        $email = $_POST['email'];
        $name = $_POST['username'];
        $pass1 = $_POST['pass1'];
        $pass2 = $_POST['pass2'];

        if ($pass1===$pass2) {
            $hashedPass = password_hash($pass1, PASSWORD_BCRYPT);
            $newUser = new User();
            $newUser->setEmail($email);
            $newUser->setUsername($name);
            $newUser->setHashPass($hashedPass);
            $newUser->saveToDB($conn);
        }
        else {
            echo 'Passwords are not identical.<br>';
        }


    }
    else {
        echo 'Please fill in all data. You missed the following fields:<br>';
        if (empty($_POST['email'])) {
            echo '- E-mail address<br>';
        }
        if (empty($_POST['username'])) {
            echo '- Username<br>';
        }
        if (empty($_POST['pass1'])) {
            echo '- Password<br>';
        }
        if (empty($_POST['pass2'])) {
            echo '- Re-entered password<br>';
        }        
    }   
}    
echo '</div>';
?>
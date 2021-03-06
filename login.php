<?php
require_once './user.php';

echo '<div id="loginpanel"><br>';
    echo '<form action="" method="post" role="form">
            <legend>Login panel</legend><br>
                <label for="email">E-mail:</label><br>
                <input type="text" name="email"><br>
                <label>Password:</label><br>
                <input type="password" name="pass"><br><br>
                <button type="submit" name="login">Login</button>
        </form>';

if ($_SERVER['REQUEST_METHOD']==='POST') {
    if (!empty($_POST['email']) && !empty($_POST['pass'])) {
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        
        $user = User::loadUserByEmail($conn, $email);
        
        if (password_verify ($pass, $user->getHashPass())) {
            $_SESSION['username'] = $user->getUsername();
            $_SESSION['useremail'] = $user->getEmail();
            $_SESSION['userid'] = $user->getUserid();
            header('refresh: 1; index.php');
        }
        else {
            echo 'Incorrect password or e-mail.<br>';
        }
    }
    else {
        echo 'Please fill in all data. You missed the following fields:<br>';
        if (empty($_POST['email'])) {
            echo '- E-mail address<br>';
        }
        if (empty($_POST['pass'])) {
            echo '- Password<br>';
        }       
    }
}
echo '</div>';
?>
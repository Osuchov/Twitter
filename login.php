<?php
require_once './user.php';

echo '<div id="loginpanel"><br>';
    echo '<form action="" method="post" role="form">
            <legend>Login panel</legend><br>
            <div>
                <label for="email">E-mail:</label><br>
                <input type="text" name="email"><br>
                <label>Password:</label><br>
                <input type="password" name="pass"><br><br>
                <button type="submit" name="login">Login</button>
            </div>
        </form>';

if ($_SERVER['REQUEST_METHOD']==='POST') {
    if (!empty($_POST['email']) && !empty($_POST['pass'])) {
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        
        $user = User::loadUserByEmail($conn, $email);
        
        if (password_verify ($pass, $user->getHashPass())) {
            echo 'Zalogowano.';
        }
        else {
            'Incorrect password or e-mail.<br>';
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
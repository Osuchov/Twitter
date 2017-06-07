<?php
require_once './user.php';

if (isset($_SESSION['useremail'])) {
    $email = $_SESSION['useremail'];
    $userid = $_SESSION['userid'];
    
    $usr = User::loadUserById($conn, $userid);
    $allUsrs = User::loadAllUsers($conn);    
    $emails=[];
    foreach ($allUsrs as $user) {
        $emails[] = $user->getEmail();
    }
        var_dump($emails);
}
?>

<html>
    <form action="" method="post">
        <div id="tweet" style="width: 50%">You can manage your profile here:<br><br>
        <button style="width: 33%" style="float: left" type="submit" name="page" value="changepass">Change password</button>
        <button style="width: 33%" style="float: right" type="submit" name="page" value="changename">Change Username</button>
        <button style="width: 33%" style="float: right" type="submit" name="page" value="changemail">Change E-mail</button>
        </div>
    </form>
</html>
<?php
if (isset($_POST['page']) && $_POST['page'] === 'changepass') {
    echo '<form action="" method="post" role="form">
            <div>
                Change your password below:<br><br>
                <label>Current password:</label><br>
                <input type="password" name="curpass"><br>                
                <label>New password:</label><br>
                <input type="password" name="pass1"><br>
                <label>Re-enter new password:</label><br>
                <input type="password" name="pass2"><br><br>
                <input type="hidden" name="page" value="changepass">
                <button type="submit" value="changepass">Change password</button>
            </div>
        </form>';

    if(!empty($_POST['curpass']) && !empty($_POST['pass1']) && !empty($_POST['pass2'])) {
        
        $curPass = $_POST['curpass'];
        $pass1 = $_POST['pass1'];
        $pass2 = $_POST['pass2'];
        
        if (password_verify ($curPass, $user->getHashPass())) {
            if ($pass1===$pass2) {
                $hashedPass = password_hash($pass1, PASSWORD_BCRYPT);
                $user->setHashPass($hashedPass);
                $user->saveToDB($conn);
            }
            else {
                echo 'Passwords are not identical.<br>';
            }            
        }
        else {
            echo 'Incorrect current password.<br>';
        }

    }
    else {
        echo 'Please fill in all data. You missed the following fields:<br>';
        if (empty($_POST['curpass'])) {
            echo '- Current password<br>';
        }
        if (empty($_POST['pass1'])) {
            echo '- Password<br>';
        }
        if (empty($_POST['pass2'])) {
            echo '- Re-entered password<br>';
        }        
    }           
}

if (isset($_POST['page']) && $_POST['page'] === 'changename') {
echo '<form action="" method="post" role="form">
            <div>
                Change your username below:<br><br>
                <label>Current password:</label><br>
                <input type="password" name="curpass"><br>                
                <label>New username:</label><br>
                <input type="text" name="username"><br>
                <input type="hidden" name="page" value="changename"><br>
                <button type="submit" value="changepass">Change username</button>
            </div>
        </form>';

    if(!empty($_POST['curpass']) && !empty($_POST['username'])) {
        
        $curPass = $_POST['curpass'];
        $username = $_POST['username'];
        
        if (password_verify ($curPass, $user->getHashPass())) {
            if (is_string($username)) {
                $usr->setUsername($username);
                $usr->saveToDB($conn);
                $_SESSION['username']=$username;
                header('refresh: 1; index.php');
            }
            else {
                echo $username.' is not a valid string.<br>';
            }            
        }
        else {
            echo 'Incorrect current password.<br>';
        }

    }
    else {
        echo 'Please fill in all data. You missed the following fields:<br>';
        if (empty($_POST['curpass'])) {
            echo '- Current password<br>';
        }
        if (empty($_POST['username'])) {
            echo '- Username<br>';
        }      
    }    
}
if (isset($_POST['page']) && $_POST['page'] === 'changemail') {
echo '<form action="" method="post" role="form">
            <div>
                Change your e-mail below:<br><br>
                <label>Current password:</label><br>
                <input type="password" name="curpass"><br>                
                <label>New e-mail:</label><br>
                <input type="text" name="email"><br>
                <input type="hidden" name="page" value="changemail"><br>
                <button type="submit" value="changemail">Change e-mail</button>
            </div>
        </form>';

    if(!empty($_POST['curpass']) && !empty($_POST['email'])) {
        
        $curPass = $_POST['curpass'];
        $newemail = $_POST['email'];
        
        if (password_verify ($curPass, $user->getHashPass())) {
            if (is_string($newemail)) {

                if (!in_array($newemail, $emails)) {
                    $usr->setEmail($newemail);
                    $usr->saveToDB($conn);
                    $_SESSION['useremail']=$newemail;
                    header('refresh: 1; index.php');                    
                }
                else {
                    echo 'We\'re sorry, but e-mail '.$newemail.' is already in use.<br>';
                    echo 'Try a different one.<br>';                    
                }
            }
            else {
                echo $newemail.' is not a valid string.<br>';
            }            
        }
        else {
            echo 'Incorrect current password.<br>';
        }

    }
    else {
        echo 'Please fill in all data. You missed the following fields:<br>';
        if (empty($_POST['curpass'])) {
            echo '- Current password<br>';
        }
        if (empty($_POST['email'])) {
            echo '- E-mail address<br>';
        }      
    }        
}

?>
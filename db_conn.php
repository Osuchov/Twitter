<?php
$conn = new mysqli (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if ($conn->connect_error) {
    die('<p style="font-size: 13">Failed to connect with database.<br>'
            . 'Error: '.$conn->connect_error.'</p><br>');
}
else {
    echo '<p style="font-size: 7">Connected.</p><br>';
}
?>
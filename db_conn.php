<?php
$conn = @new mysqli (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if ($conn->connect_error) {
    echo '<div class="noconnection">Failed to connect with database.<br>'
            . 'Error: '.$conn->connect_error.'</div><br>';
}
else {
    echo '<div class="connection">Connected.</div>';
}
?>
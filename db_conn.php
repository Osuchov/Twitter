<?php
require_once './config.php';

$conn = @new mysqli (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if ($conn->connect_error) {
    echo '<div class="connection" style="color: red">Failed to connect with database. Error: '.$conn->connect_error.'</div>';
}
else {
    echo '<div class="connection">Connected.</div>';
}
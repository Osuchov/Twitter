<?php
require_once './config.php';
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if ($conn->connect_error) {
    die('Połączenie nieudane, Błąd: '.$conn->connect_error.'<br>');
}
else {
    echo 'Połączenie udane.<br>';
}

//$sql = 'Insert INTO Payments (type, date) VALUES ("Karta płatnicza", "2017-04-23")';
//if ($res = $conn->query($sql)) {
//    echo 'Dodatnie rekordu się powiodło.<br>';
//    echo 'ID nowego rekrdu to: '.$conn->insert_id.'<br>';
//}
//else {
//    echo 'Nie udało się dodać rekordu.<br>';
//}    
?>
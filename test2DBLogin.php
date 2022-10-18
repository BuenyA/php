<?php
$DSN = 'mysql:host=db;dbname=shoutbox';
$db = new PDO($DSN, 'root', '');

session_start();
if (sizeof($_POST) !== 0) {
    $queryInserat = "SELECT * FROM user WHERE login = '" . $_POST['login'] . "'" . " AND passwd = '" . $_POST['password'] . "'";
    $res = $db->query($queryInserat);
    if ($res !== false && $res->rowCount() > 0) {
        echo 'Eingeloggt';
        $_SESSION['user'] = $_POST['login']; // login
        $_SESSION['count'] = 0;
    } else {
        echo 'Nochmal';
    }
}
?>
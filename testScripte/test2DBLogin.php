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

if (empty($_SESSION['user'])) {
    echo '
 <form method="post">
 Login / Passwort:<br />
 <input type="text" name="login" /><br />
 <input type="password" name="password" /><br />
 <input type="submit" value="login" /><br />
 </form>';
    exit; // unangemeldet geht es nicht weiter
}

++$_SESSION['count'];
echo '
 Hallo <a href="' . $_SERVER['SCRIPT_NAME'] . '">' . $_SESSION['user'] . '</a>!<br />
 Ich seh dich schon zum ' . $_SESSION['count'] . ' Mal.';
 echo '<button>Log Out</button>';
if ($_SESSION['count'] > 5) {
    session_destroy(); // logout
}
?>
<?php

$dsn = 'mysql:dbname=Autostar;host=db;port=3306';

try {
    $db = new PDO( $dsn, 'root', '' );
} catch (PDOException $e){
    exit( 'Connection failed: ' . $e->getMessage());
}
?>
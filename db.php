<?php
    class DB extends PDO {
        public function query(string $statement, ?int $mode = PDO::FETCH_ASSOC, mixed ...$fetch_mode_args):PDOStatement|false
        {
            try {
                return parent::query($statement, $mode, ...$fetch_mode_args);
            } catch (PDOException $e) {
                echo '<br/>DB ERROR: ' . $e->getMessage();
                echo '<br/>Query: ' . $statement;
                return false;
            }
        }
    }
    
    //Stellt eine Datenbankverbindung mit der Datenbank "Autostar" her
    $dsn = 'mysql:dbname=Autostar;host=db;port=3306';
    try {
        $db = new PDO( $dsn, 'root', '' );
    } catch (PDOException $e){
        exit( 'Connection failed: ' . $e->getMessage());
    }
?>
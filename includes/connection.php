<?php
//ligar à base de dados
$userBd = 'root';
$passBd = '';
try {
    $dbh = new PDO('mysql:host=127.0.0.1;dbname=bma; charset=utf8', $userBd, $passBd);
    $dbh->exec("SET lc_time_names = 'pt_PT'");
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

<?php
error_reporting(E_ALL ^ E_WARNING);
session_start();
$pedido = $_GET["pedido"] ?? '';

function upadatePassword($id, $newpassword)
{
    require("connection.php");
    $sql = "UPDATE users SET passUtilizador = :newPass WHERE id = :id";
    $sth = $dbh->prepare($sql);
    $sth->bindParam(":newPass", $newpassword);
    $sth->bindParam(":id", $id);
    $sth->execute();

    if ($sth && $sth->rowCount() > 0) {
        $_SESSION['erro'] = '<span class="text-success fs-2">Password Atualizada</span>';
        header("Location:../index.php");
    }
}


if ($pedido == 'newPassword') {
    $newpassword = $_POST['passwordNew'] ?? '';
    $id = $_POST['id'] ?? '';
    upadatePassword($id, $newpassword);
}
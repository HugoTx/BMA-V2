<?php
error_reporting(E_ALL ^ E_WARNING);
session_start();
$pedido = $_GET["pedido"] ?? '';

function upadatePassword($old, $newpassword, $newpassword1)
{
    require("connection.php");
    $login = "SELECT id, passUtilizador, username, nome, email, tipoAdmin,estado, count(*) as contagem FROM users WHERE username = :nome";
    $sth = $dbh->prepare($login);
    $sth->bindParam(":id", $id);
    $sth->execute();
    $query = $sth->fetchObject();
    $userPassword = $query->passUtilizador;
    $_SESSION['nomeProfessor'] = $query->nome;
    $_SESSION['tipo'] = $query->tipoAdmin;
    $_SESSION['user'] = $query->username;
    $_SESSION['email'] = $query->email;
    $_SESSION['passUt'] = $query->passUtilizador;
    $res = $query->contagem;
    if ($query->passUtilizador !== $old) {
        $_SESSION['erro'] = '<span class="text-danger fs-3"> Password atual errada!</span>';
        // } else {
        //     if ($res == 0) {
        //         header("Location:../index.php");
        //         $_SESSION['erro'] = '<span class="text-danger fs-3"> Utilizador não existe!</span>';
        //     }
        //     if ($res == 1) {
        //         if ($password == "") {
        //             header("Location:../index.php");
        //             $_SESSION['erro'] = '<span class="text-danger fs-3"> Introduza uma password!</span>';
        //         } elseif ($password != $userPassword) {
        //             header("Location:../index.php");
        //             $_SESSION['erro'] = '<span class="text-danger fs-3">Password Errada!</span>';
        //         } elseif ($password == $userPassword) {
        //             header("Location:../entrada.php");
        //             $_SESSION['boasVindas'] = '<span class="text-dark fs-1">Bem vindo </span>';
        //         }
        //     }
    }
}


if ($pedido == 'newPassword') {
    $old = $_POST['passwordU'] ?? '';
    $newpassword = $_POST['passwordNew'] ?? '';
    $newpassword1 = $_POST['passwordNew1'] ?? '';
    $id = $_SESSION['id'];
    upadatePassword($old, $newpassword, $newpassword1);
}
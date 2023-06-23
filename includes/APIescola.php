<?php
error_reporting(E_ALL ^ E_WARNING);
session_start();
$pedido = $_GET["pedido"] ?? '';

function verificaLogin($username, $password)
{
    require("connection.php");
    $login = "SELECT id, passUtilizador, username, nome, email, tipoAdmin,estado, count(*) as contagem FROM users WHERE username = :nome";
    $sth = $dbh->prepare($login);
    $sth->bindParam(":nome", $username);
    $sth->execute();
    $query = $sth->fetchObject();
    $userPassword = $query->passUtilizador;
    $_SESSION['nomeProfessor'] = $query->nome;
    $_SESSION['tipo'] = $query->tipoAdmin;
    $_SESSION['id'] = $query->id;
    $res = $query->contagem;
    if ($query->estado == 0 && $res == 1) {
        header("Location:../index.php");
        $_SESSION['erro'] = '<span class="text-danger fs-3"> Utilizador inativo!</span>';
    } else {
        if ($res == 0) {
            header("Location:../index.php");
            $_SESSION['erro'] = '<span class="text-danger fs-3"> Utilizador não existe!</span>';
        }
        if ($res == 1) {
            if ($password == "") {
                header("Location:../index.php");
                $_SESSION['erro'] = '<span class="text-danger fs-3"> Introduza uma password!</span>';
            } elseif ($password != $userPassword) {
                header("Location:../index.php");
                $_SESSION['erro'] = '<span class="text-danger fs-3">Password Errada!</span>';
            } elseif ($password == $userPassword) {
                header("Location:../entrada.php");
                $_SESSION['boasVindas'] = '<span class="text-dark fs-1">Bem vindo </span>';
            }
        }
    }
}
function registaUtilizadores($nome, $pass, $tipoAdmin, $username, $email)
{
    if (empty($nome) || empty($pass) || empty($username) || empty($email)) {
        $_SESSION['mensagem'] = '<span class="text-danger fs-2">Preencha todos os campos!</span>';
        header("Location:../registoUtilizadores.php");
    } else {
        require("connection.php");
        $sql = "INSERT INTO users (username,email, passUtilizador, nome, tipoAdmin) VALUES(:username,:email, :passo, :nome, :tipoAdmin)";
        $sth = $dbh->prepare($sql);
        $sth->bindParam(":nome", $nome);
        $sth->bindParam(":passo", $pass);
        $sth->bindParam(":tipoAdmin", $tipoAdmin);
        $sth->bindParam(":username", $username);
        $sth->bindParam(":email", $email);
        $sth->execute();

        if ($sth && $sth->rowCount() > 0) {

            $_SESSION['mensagem'] = '<span class="text-success fs-2">Utilizador Registado</span>';
            header("Location:../registoUtilizadores.php");
        }
    }
}
function alteraEstado($id, $estado)
{
    require("connection.php");
    if ($estado == 0) {
        $sql = "UPDATE users SET estado = 1 WHERE id = :id";
        $sth = $dbh->prepare($sql);
        $sth->bindParam(":id", $id);
        $sth->execute();
    }
    if ($estado == 1) {
        $sql = "UPDATE users SET estado = 0 WHERE id = :id";
        $sth = $dbh->prepare($sql);
        $sth->bindParam(":id", $id);
        $sth->execute();
    }
    if ($sth && $sth->rowCount() > 0) {

        $_SESSION['mensagem'] = '<span class="text-success fs-2">Estado alterado com sucesso!</span>';
        header("Location:../estadoUtilizadores.php");
    }
}


if ($pedido == "ativaUser") {
    $id = $_GET["id"];
    $estado = 0;
    alteraEstado($id, $estado);
}
if ($pedido == "inativaUser") {
    $id = $_GET["id"];
    $estado = 1;
    alteraEstado($id, $estado);
}

if ($pedido == 'registaUtilizadores') {
    $nome = $_POST['nomeU'];
    $pass = $_POST['passwordU'];
    $tipoAdmin = $_POST['tipoAdminU'];
    $username = $_POST['usernameU'];
    $email = $_POST['emailU'];
    registaUtilizadores($nome, $pass, $tipoAdmin, $username, $email);
}
if ($pedido == 'verificaFuncionario') {
    $user = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    verificaLogin($user, $password);
}
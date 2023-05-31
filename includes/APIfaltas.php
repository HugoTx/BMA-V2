<?php
session_start();
$pedido = $_GET["acao"] ?? '';

//******LISTAR FALTAS DISCIPLINA ***********/
function listaFaltas($disciplina)
{
    require('connection.php');
    $data_string = "";
    $sql = 'SELECT * FROM faltas';
    if (!empty($disciplina)) {
        $sql .= ' WHERE disciplina= :disciplina';
        $sth = $dbh->prepare($sql);
        $sth->bindParam(":disciplina", $disciplina);
        $sth->execute();
    } else {
        header("Location:../entrada.php");
    }
    header('Content-Type: application/json');
    $data_string .= '{"disciplina": [';
    $arrfaltas = array();
    while ($lista = $sth->fetchObject()) {
        $arrFalta = array(
            "licao" => $lista->licao,
            "dataaula" => $lista->dataaula,
            "aluno" => $lista->aluno,
            "disciplina" => $lista->disciplina,
            "falta" => $lista->falta
        );
        $arrfaltas[] = $arrFalta;
    }
    $data_string = substr($data_string, 0, -1);
    $data_string .= ']}';
    echo json_encode(array("disciplinas" => $arrfaltas), JSON_UNESCAPED_UNICODE);
}
//******LISTAR FALTAS ALUNO ***********/
function listaFaltasaluno($aluno)
{
    require('connection.php');
    $data_string = "";
    $sql = 'SELECT * FROM faltas';
    if (!empty($aluno)) {
        $sql .= ' WHERE aluno = :nome';
        $sth = $dbh->prepare($sql);
        $sth->bindParam(":nome", $aluno);
        $sth->execute();
    } else {
        header("Location:../entrada.php");
    }
    header('Content-Type: application/json');
    $data_string .= '{"aluno": [';
    $arrSumarios = array();
    while ($lista = $sth->fetchObject()) {
        $arrSumario = array(
            "licao" => $lista->licao,
            "dataaula" => $lista->dataaula,
            "aluno" => $lista->aluno,
            "disciplina" => $lista->disciplina,
            "falta" => $lista->falta
        );
        $arrSumarios[] = $arrSumario;
    }
    $data_string = substr($data_string, 0, -1);
    $data_string .= ']}';
    echo json_encode(array("alunos" => $arrSumarios), JSON_UNESCAPED_UNICODE);
}

//******LISTAR FALTAS POR DATA E DISCIPLINA ***********/

function listaFaltasDataDisciplina($dataIni, $dataFim, $disciplina)
{
    require('connection.php');
    $data_string = "";
    $sql = 'SELECT * FROM faltas';
    if (!empty($disciplina)) {
        $sql .= ' WHERE dataaula BETWEEN :dataInicio AND :dataFim AND disciplina = :disciplina';
        $sth = $dbh->prepare($sql);
        $sth->bindParam(":disciplina", $disciplina);
        $sth->bindParam(":dataFim", $dataFim);
        $sth->bindParam(":dataInicio", $dataIni);
        $sth->execute();
    } else {
        header("Location:../entrada.php");
    }
    header('Content-Type: application/json');
    $data_string .= '{"disciplina": [';
    $arrfaltas = array();
    while ($lista = $sth->fetchObject()) {
        $arrFalta = array(
            "licao" => $lista->licao,
            "dataaula" => $lista->dataaula,
            "aluno" => $lista->aluno,
            "disciplina" => $lista->disciplina,
            "falta" => $lista->falta
        );
        $arrfaltas[] = $arrFalta;
    }
    $data_string = substr($data_string, 0, -1);
    $data_string .= ']}';
    echo json_encode(array("disciplinas" => $arrfaltas), JSON_UNESCAPED_UNICODE);
}
//******LISTAR FALTAS POR DATA E ALUNO ***********/
function listaFaltasDataAluno($dataIni, $dataFim, $nome)
{
    require('connection.php');
    $data_string = "";
    $sql = 'SELECT * FROM faltas';
    if (!empty($nome)) {
        $sql .= ' WHERE dataaula BETWEEN :dataInicio AND :dataFim AND aluno = :nome';
        $sth = $dbh->prepare($sql);
        $sth->bindParam(":nome", $nome);
        $sth->bindParam(":dataFim", $dataFim);
        $sth->bindParam(":dataInicio", $dataIni);
        $sth->execute();
    } else {
        header("Location:../entrada.php");
    }
    header('Content-Type: application/json');
    $data_string .= '{"disciplina": [';
    $arrfaltas = array();
    while ($lista = $sth->fetchObject()) {
        $arrFalta = array(
            "licao" => $lista->licao,
            "dataaula" => $lista->dataaula,
            "aluno" => $lista->aluno,
            "disciplina" => $lista->disciplina,
            "falta" => $lista->falta
        );
        $arrfaltas[] = $arrFalta;
    }
    $data_string = substr($data_string, 0, -1);
    $data_string .= ']}';
    echo json_encode(array("disciplinas" => $arrfaltas), JSON_UNESCAPED_UNICODE);
}

//****** REGISTRAR FALTA ***********/

function registaFalta($licao, $data, $turmaAluno, $disciplina, $falta)
{
    require("connection.php");
    if (empty($turmaAluno) || empty($disciplina) || empty($falta) || empty($data) || empty($licao)) {
        $_SESSION['mensagem'] = '<span class="text-danger fs-2">Preencha todos os campos!</span>';
        header("Location:../registofaltas.php");
    } else {
        $sql = "INSERT INTO faltas (licao, dataaula, aluno, disciplina, falta) VALUES (:licao, :dataaula, :turma, :disciplina, :falta)";
        $sth  = $dbh->prepare($sql);
        $sth->bindParam(":licao", $licao);
        $sth->bindParam(":dataaula", $data);
        $sth->bindParam(":disciplina", $disciplina);
        $sth->bindParam(":falta", $falta);
        $sth->bindParam(":turma", $turmaAluno);
        $sth->execute();

        if ($sth && $sth->rowCount() > 0) {

            $_SESSION['mensagem'] = '<span class="text-success fs-2">Falta Registada</span>';
            header("Location:../registofaltas.php");
        }
    }
}




if ($pedido == "listaFaltasDataAluno") {
    $dataIni = $_GET["dataIni"];
    $dataFim = $_GET["dataFim"];
    $nome = $_GET["nome"];
    listaFaltasDataAluno($dataIni, $dataFim, $nome);
}
if ($pedido == "listaFaltasDataDisciplina") {
    $dataIni = $_GET["dataIni"];
    $dataFim = $_GET["dataFim"];
    $disciplina = $_GET["disciplina"];
    listaFaltasDataDisciplina($dataIni, $dataFim, $disciplina);
}
if ($pedido == "listaFaltasaluno") {
    $nome = $_GET["nome"] ?? '';
    listaFaltasaluno($nome);
}

if ($pedido == "listaFaltas") {
    $disciplina = $_GET["disciplina"] ?? '';
    listaFaltas($disciplina);
}
if ($pedido == "registaFalta") {
    $licao = $_POST["licao"];
    $data = $_POST["date"];
    $turmaAluno = $_POST["turmaAluno"];
    $disciplina = $_POST["disciplina"];
    $falta = $_POST["falta"];
    registaFalta($licao, $data, $turmaAluno, $disciplina, $falta);
}

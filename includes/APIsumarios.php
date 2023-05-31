<?php
session_start();
$pedido = $_GET["acao"] ?? '';

//****** REGISTRAR SUMÁRIOS ***********/
function enviasumario($licao, $data, $turmaAluno, $disciplina, $sumario)
{
    if (empty($licao) || empty($turmaAluno) || empty($disciplina) || empty($sumario) || empty($data)) {
        $_SESSION['mensagem'] = '<span class="text-danger fs-2">Preencha todos os campos!</span>';
        header("Location:../registosumarios.php");
    } else {

        require("connection.php");
        if ($_SESSION)
            $sql = "INSERT INTO sumarios (licao, dataaula,turma_aluno,disciplina,sumario) VALUES (:licao, :dataaula, :turma, :disciplina, :sumario)";
        $sth  = $dbh->prepare($sql);
        $sth->bindParam(":licao", $licao);
        $sth->bindParam(":dataaula", $data);
        $sth->bindParam(":disciplina", $disciplina);
        $sth->bindParam(":sumario", $sumario);
        $sth->bindParam(":turma", $turmaAluno);
        $sth->execute();

        if ($sth && $sth->rowCount() > 0) {

            $_SESSION['mensagem'] = '<span class="text-success fs-2">Sumário Registado</span>';
            header("Location:../registosumarios.php");
        }
    }
}

//******LISTAR SUMÁRIOS DISCIPLINA ***********/
function listaSumarios($disciplina)
{
    require('connection.php');
    $data_string = "";
    $sql = 'SELECT * FROM sumarios';
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
    $arrSumarios = array();
    while ($lista = $sth->fetchObject()) {
        $arrSumario = array(
            "licao" => $lista->licao,
            "dataaula" => $lista->dataaula,
            "turma_aluno" => $lista->turma_aluno,
            "disciplina" => $lista->disciplina,
            "sumario" => $lista->sumario
        );
        $arrSumarios[] = $arrSumario;
    }
    $data_string = substr($data_string, 0, -1);
    $data_string .= ']}';
    echo json_encode(array("disciplinas" => $arrSumarios), JSON_UNESCAPED_UNICODE);
}

//******LISTAR SUMÁRIOS ALUNO ***********/
function listaSumariosaluno($turma_aluno)
{
    require('connection.php');
    $data_string = "";
    $sql = 'SELECT * FROM sumarios';
    if (!empty($turma_aluno)) {
        $sql .= ' WHERE turma_aluno = :nome';
        $sth = $dbh->prepare($sql);
        $sth->bindParam(":nome", $turma_aluno);
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
            "turma_aluno" => $lista->turma_aluno,
            "disciplina" => $lista->disciplina,
            "sumario" => $lista->sumario
        );
        $arrSumarios[] = $arrSumario;
    }
    $data_string = substr($data_string, 0, -1);
    $data_string .= ']}';
    echo json_encode(array("alunos" => $arrSumarios), JSON_UNESCAPED_UNICODE);
}

//******LISTAR SUMÁRIOS POR DATA E DISCIPLINA ***********//
function listaSumariosDataDisciplina($dataIni, $dataFim, $disciplina)
{
    require('connection.php');
    $data_string = "";
    $sql = 'SELECT * FROM sumarios';
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
    $arrSumarios = array();
    while ($lista = $sth->fetchObject()) {
        $arrSumario = array(
            "licao" => $lista->licao,
            "dataaula" => $lista->dataaula,
            "turma_aluno" => $lista->turma_aluno,
            "disciplina" => $lista->disciplina,
            "sumario" => $lista->sumario
        );
        $arrSumarios[] = $arrSumario;
    }
    $data_string = substr($data_string, 0, -1);
    $data_string .= ']}';
    echo json_encode(array("disciplinas" => $arrSumarios), JSON_UNESCAPED_UNICODE);
}

//******LISTAR SUMÁRIOS POR DATA E ALUNO ***********//
function listaSumariosDataAluno($dataIni, $dataFim, $nome)
{
    require('connection.php');
    $data_string = "";
    $sql = 'SELECT * FROM sumarios';
    if (!empty($nome)) {
        $sql .= ' WHERE dataaula BETWEEN :dataInicio AND :dataFim AND turma_aluno = :nome';
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
    $arrSumarios = array();
    while ($lista = $sth->fetchObject()) {
        $arrSumario = array(
            "licao" => $lista->licao,
            "dataaula" => $lista->dataaula,
            "turma_aluno" => $lista->turma_aluno,
            "disciplina" => $lista->disciplina,
            "sumario" => $lista->sumario
        );
        $arrSumarios[] = $arrSumario;
    }
    $data_string = substr($data_string, 0, -1);
    $data_string .= ']}';
    echo json_encode(array("disciplinas" => $arrSumarios), JSON_UNESCAPED_UNICODE);
}

//****** PEDIDOS ****
if ($pedido == "listaSumariosDataAluno") {
    $dataIni = $_GET["dataIni"];
    $dataFim = $_GET["dataFim"];
    $nome = $_GET["nome"];
    listaSumariosDataAluno($dataIni, $dataFim, $nome);
}
if ($pedido == "listaSumariosDataDisciplina") {
    $dataIni = $_GET["dataIni"];
    $dataFim = $_GET["dataFim"];
    $disciplina = $_GET["disciplina"];
    listaSumariosDataDisciplina($dataIni, $dataFim, $disciplina);
}
if ($pedido == "listaSumariosaluno") {
    $nome = $_GET["nome"] ?? '';
    listaSumariosaluno($nome);
}
if ($pedido == "listaSumarios") {
    $disciplina = $_GET["disciplina"] ?? '';
    listaSumarios($disciplina);
}
if ($pedido == 'enviasumario') {
    $licao = $_POST["licao"];
    $data = $_POST["date"];
    $turmaAluno = $_POST["turmaAluno"];
    $disciplina = $_POST["disciplina"];
    $sumario = $_POST["sumario"];
    enviasumario($licao, $data, $turmaAluno, $disciplina, $sumario);
}

<?php
session_start();
if (!isset($_SESSION['boasVindas'])) {
    header('Location:index.php');
    exit();
}
$mensagem = $_SESSION['mensagem'];
$_SESSION['mensagem'] = '';

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BMA</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-icons.css">

</head>

<body>
    <!--logo-->
    <?php
    require("includes/menu.php");
    ?>
    <div class="text-center mt-2">
        <h1>REGISTO DE FALTAS</h1>
    </div>
    <div class="row text-center">
        <a href="entrada.php"><button class="btn btn-outline-secondary" id="retroceder">Retroceder</button></a>
    </div>

    <!-- FORMULÁRIO DE REGISTO -->

    <div class="container w-50 mt-5 mb-4 border border-5 ">
        <form action="includes/APIfaltas.php?acao=registaFalta" method="POST">

            <div class="form-group mt-4">
                <label class="col-sm-2 control-label fw-bold">Lição Nº</label>
                <input type="number" class="form-group" id="licao" name="licao" min="1">
            </div>

            <div class="form-group mt-4">
                <label class="col-sm-2 control-label fw-bold">Data</label>
                <input type="date" class="form-group" id="date" name="date">
            </div>

            <div class="form-group mt-4">
                <label class="col-sm-2 control-label fw-bold">Aluno</label>
                <input type="text" class="form-group" id="turmaAluno" name="turmaAluno">
            </div>

            <div class="form-group mt-4">
                <label class="col-sm-2 control-label fw-bold">Disciplina</label>
                <select name="disciplina" id="disciplina" class="form-group">
                    <option value="" selected>Disciplina</option>
                    <option value="Banda Juvenil">Banda Juvenil</option>
                    <option value="Clarinete">Clarinete</option>
                    <option value="Eufónio">Eufónio</option>
                    <option value="Expressão Musical">Expressão Musical</option>
                    <option value="Fagote">Fagote</option>
                    <option value="Flauta Transversal">Flauta Transversal</option>
                    <option value="Formação Musical">Formação Musical</option>
                    <option value="Iniciação Musical">Iniciação Musical</option>
                    <option value="Música para crianças">Música para crianças</option>
                    <option value="Oboé">Oboé</option>
                    <option value="Percussão">Percussão</option>
                    <option value="Saxofone">Saxofone</option>
                    <option value="Tombone">Trombone</option>
                    <option value="Trompa">Trompa</option>
                    <option value="Trompete">Trompete</option>
                </select>
            </div>

            <div class="form-group mt-4">
                <label class="col-sm-2 control-label fw-bold">Falta</label>
                <select name="falta" id="falta" class="form-group">
                    <option value="" selected>Falta</option>
                    <option value="Sim">Sim</option>
                    <option value="Não">Não</option>
                </select>
            </div>
            <div class="text-center mb-2 mt-4">
                <button type="submit" class="btn btn-outline-primary w-100 p-2 text-uppercase">Registar</button>
            </div>

        </form>
        <div class="center"> <text id="mensagem"><?= $mensagem ?></text></div>
    </div>
    <script src="jquery/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script>
        setTimeout(function() {

            $("#mensagem").hide()

        }, 2000);
    </script>
</body>

</html>
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
        <a href="entrada.php"><button class="btn btn-outline-secondary mb-4" id="retroceder">Retroceder</button></a>
    </div>

    <!-- FORMULÁRIO DE REGISTO -->

    <div class="container">
        <div class="row">
            <div class="col-lg-7 mx-auto">
                <div class="card mt-2 mx-auto p-4 bg-light">
                    <div class="card-body bg-light">
                        <div class="container">
                            <form action="includes/APIfaltas.php?acao=registaFalta" method="POST">
                                <div class="controls">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Lição Nº</label>
                                                <input type="number" class="form-control" id="licao" name="licao"
                                                    min="1">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Data</label>
                                                <input type="date" class="form-control" id="date" name="date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Turma / Aluno</label>
                                                <input type="text" class="form-control" id="turmaAluno"
                                                    name="turmaAluno">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Disciplina</label>
                                                <select name="disciplina" id="disciplina" class="form-control">
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
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-6 mt-2">
                                            <div class="form-group">
                                                <label>Falta</label>
                                                <select name="falta" id="falta" class="form-control">
                                                    <option value="" selected>Falta</option>
                                                    <option value="Sim">Sim</option>
                                                    <option value="Não">Não</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 d-none"></div>
                                    </div>
                                    <div class="col-md-12 d-flex flex-row-reverse mt-2 me-2">
                                        <button type="submit" class="btn btn-outline-primary pt-2">Registar</button>
                                    </div>

                            </form>
                            <div class="center"> <text id="mensagem">
                                    <?= $mensagem ?>
                                </text></div>
                        </div>
                        <script src="jquery/jquery.min.js"></script>
                        <script src="js/bootstrap.bundle.min.js"></script>
                        <script>
                            setTimeout(function () {

                                $("#mensagem").hide()

                            }, 2000);
                        </script>
</body>

</html>
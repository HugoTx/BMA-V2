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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="js/script.js"></script>
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
        <h1>LISTAGEM DE FALTAS</h1>
    </div>
    <div class="row text-center">
        <a href="entrada.php"><button class="btn btn-outline-secondary mb-4" id="retroceder">Retroceder</button></a>
    </div>


    <!-- ***************** POR DISCIPLINA ************************** -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-xl col-md-6 mb-4 ms-2">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2 text-center mt-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Todos por Disciplina </div>
                            </div>
                            <div class="container w-50 ">
                                <div class="form-group mt-4">
                                    <select name="nomeDisciplina" id="disciplina" class="form-group">
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
                                    <button onclick="alterClass()" class="btn btn-outline-primary ml-3"
                                        id="procurarDisciplina" type="button">Procurar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--********** POR TURMA / ALUNO ***************-->
            <div class="col-xl col-md-6 mb-4 ms-2">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2 text-center mt-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Turma / Aluno</div>
                            </div>
                            <div class="container w-50">
                                <div class="form-group mt-4">
                                    <form action="" method="POST">
                                        <input type="text" class="form-group" id="nome" name="nomeAluno"
                                            placeholder="Turma / Aluno">
                                        <button onclick="alterClass()" class="btn btn-outline-primary ml-3"
                                            id="procurarAluno" type="button">Procurar</button>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ********** DISCIPLINAS POR DATA *************** -->
        <div class="row">
            <div class="col-xl col-md-6 mb-4 ms-2">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2 text-center mt-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Disciplinas por data</div>
                            </div>
                            <div class="container w-50">
                                <div class="form-group mt-4">
                                    <form action="" method="POST">
                                        <div class="mb-1"> Data inicial </div><input type="date" class="form-group"
                                            id="dataInicio" name="dataInicio">
                                        <div class="mb-1 mt-1"> Data Final </div><input type="date" class="form-group"
                                            id="dataFim" name="dataFim">
                                        <div class="mb-1 mt-1">
                                            <select name="nomeDisciplina" id="disciplinaData" class="form-group">
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
                                            <button onclick="alterClass()" class="btn btn-outline-primary ml-3"
                                                id="procurarDisciplinaData" type="button">Procurar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ********** ALUNOS POR DATA *************** -->
            <div class="col-xl col-md-6 mb-4 ms-2">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2 text-center mt-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Aluno por data</div>
                            </div>
                            <div class="container w-50">
                                <div class="form-group mt-4">
                                    <form action="" method="POST">
                                        <div class="mb-1"> Data inicial </div><input type="date" class="form-group"
                                            id="dataInicioAluno" name="dataInicio">
                                        <div class="mb-1 mt-1"> Data Final </div><input type="date" class="form-group"
                                            id="dataFimAluno" name="dataFim">
                                        <div class="mb-1 mt-1">
                                            <input type="text" class="form-group" id="nomeAlunoData"
                                                name="nomeAlunoData" placeholder="Turma / Aluno">

                                            <button onclick="alterClass()" class="btn btn-outline-primary ml-3"
                                                id="procurarAlunoData" type="button">Procurar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container w-100 mt-4 mb-4 d-none" id="table_sumario_faltas">
        <table class="table w-100 table-striped table-primary table-bordered table-hover table-responsive mt-4"
            id="novaPesquisaFaltas">
            <thead>
                <tr>
                    <th scope="col" class="text-center ">Lição </th>
                    <th scope="col" class="text-center"> Data e Hora</th>
                    <th scope="col" class="text-center"> Turma / Aluno</th>
                    <th scope="col" class="text-center"> Disciplina</th>
                    <th scope="col" class="text-center"> Falta</th>
                </tr>
            </thead>
            <tbody> </tbody>
        </table>
        <div class="d-flex flex-row-reverse">
            <button onclick="exportTableToExcel('novaPesquisaFaltas', 'faltas')" class="btn btn-outline-primary ml-3"
                id="retroceder">Exportar Excel</button>
        </div>

    </div>
    <script src="js/xlsx.full.min.js"></script>
    <script src="jquery/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script>
        setTimeout(function () {

            $("#mensagem").hide()

        }, 2000);
    </script>

</body>

</html>
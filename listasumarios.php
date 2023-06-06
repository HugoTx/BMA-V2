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
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-icons.css">


</head>

<body>
    <!--logo-->
    <?php
    require("includes/menu.php");
    ?>

    <div class="text-center mt-2">
        <h1>LISTAGEM DE SUMÁRIOS</h1>
    </div>
    <div class="row text-center">
        <a href="entrada.php"><button class="btn btn-outline-secondary" id="retroceder">Retroceder</button></a>
    </div>

    
    <!-- ***************** POR DISCIPLINA ************************** -->
    <script>
        $(document).ready(function() {
            $("#procurarDisciplina").click(function() {
                $("#novaPesquisa tbody").find("tr").remove();
                var disc = $("#disciplina").val();
                $.getJSON("includes/APIsumarios.php?acao=listaSumarios&disciplina=" + disc,
                    function(listaSumarios) {
                        for (x = 0; x < listaSumarios.disciplinas.length; x++) {
                            var row = listaSumarios.disciplinas[x];
                            var sumarios =
                                '<tr id="linha" class="table-light">' +
                                '<td class="text-center align-middle" id="licao">' + row
                                .licao + '</td>' +
                                '<td class="text-center align-middle" id="dataaula">' + row
                                .dataaula + '</td>' +
                                '<td class="text-center align-middle" id="turma_aluno">' + row
                                .turma_aluno + '</td>' +
                                '<td class="text-center align-middle" id="nomeAnimal">' +
                                row.disciplina + '</td>' +
                                '<td class="text-center align-middle" id="telefone">' +
                                row.sumario + '</td>' +
                                '</tr>';
                            $('#novaPesquisa').find('tbody').append(sumarios);
                        }
                    });
            });
        });
    </script>

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
                                    <button onclick="alterClass()" class="btn btn-outline-primary ml-3" id="procurarDisciplina" type="button">Procurar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--********** POR TURMA / ALUNO ***************-->

            <script>
                $(document).ready(function() {
                    $("#procurarAluno").click(function() {
                        $("#novaPesquisa tbody").find("tr").remove();
                        var nome = $("#nome").val();
                        $.getJSON("includes/APIsumarios.php?acao=listaSumariosaluno&nome=" + nome,
                            function(listaSumariosaluno) {
                                for (x = 0; x < listaSumariosaluno.alunos.length; x++) {
                                    var row = listaSumariosaluno.alunos[x];
                                    var sumarios =
                                        '<tr id="linha" class="table-light">' +
                                        '<td class="text-center align-middle" id="licao">' + row
                                        .licao + '</td>' +
                                        '<td class="text-center align-middle" id="dataaula">' + row
                                        .dataaula + '</td>' +
                                        '<td class="text-center align-middle" id="turma_aluno">' + row
                                        .turma_aluno + '</td>' +
                                        '<td class="text-center align-middle" id="nomeAnimal">' +
                                        row.disciplina + '</td>' +
                                        '<td class="text-center align-middle" id="telefone">' +
                                        row.sumario + '</td>' +
                                        '</tr>';
                                    $('#novaPesquisa').find('tbody').append(sumarios);
                                }
                            });
                    });
                });
            </script>
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
                                        <input type="text" class="form-group" id="nome" name="nomeAluno" placeholder="Turma / Aluno">
                                        <button onclick="alterClass()" class="btn btn-outline-primary ml-3" id="procurarAluno" type="button">Procurar</button>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ********** DISCIPLINAS POR DATA *************** -->
        <script>
            $(document).ready(function() {
                $("#procurarDisciplinaData").click(function() {
                    $("#novaPesquisa tbody").find("tr").remove();
                    var dataIn = $("#dataInicio").val();
                    var dataF = $("#dataFim").val();
                    var dis = $("#disciplinaData").val();
                    $.getJSON("includes/APIsumarios.php?acao=listaSumariosDataDisciplina&dataIni=" + dataIn + "&dataFim=" + dataF + "&disciplina=" + dis,
                        function(listaSumariosDataDisciplina) {
                            for (x = 0; x < listaSumariosDataDisciplina.disciplinas.length; x++) {
                                var row = listaSumariosDataDisciplina.disciplinas[x];
                                var sumarios =
                                    '<tr id="linha" class="table-light">' +
                                    '<td class="text-center align-middle" id="licao">' + row
                                    .licao + '</td>' +
                                    '<td class="text-center align-middle" id="dataaula">' + row
                                    .dataaula + '</td>' +
                                    '<td class="text-center align-middle" id="turma_aluno">' + row
                                    .turma_aluno + '</td>' +
                                    '<td class="text-center align-middle" id="nomeAnimal">' +
                                    row.disciplina + '</td>' +
                                    '<td class="text-center align-middle" id="telefone">' +
                                    row.sumario + '</td>' +
                                    '</tr>';
                                $('#novaPesquisa').find('tbody').append(sumarios);
                            }
                        });
                });
            });
        </script>

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
                                        <div class="mb-1"> Data inicial </div><input type="date" class="form-group" id="dataInicio" name="dataInicio">
                                        <div class="mb-1 mt-1"> Data Final </div><input type="date" class="form-group" id="dataFim" name="dataFim">
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
                                            <button onclick="alterClass()" class="btn btn-outline-primary ml-3" id="procurarDisciplinaData" type="button">Procurar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ********** ALUNOS POR DATA *************** -->
            <script>
                $(document).ready(function() {
                    $("#procurarAlunoData").click(function() {
                        $("#novaPesquisa tbody").find("tr").remove();
                        var dataIn = $("#dataInicioAluno").val();
                        var dataF = $("#dataFimAluno").val();
                        var nome = $("#nomeAlunoData").val();
                        console.log(dataIn, dataF, nome);
                        $.getJSON("includes/APIsumarios.php?acao=listaSumariosDataAluno&dataIni=" + dataIn + "&dataFim=" + dataF + "&nome=" + nome,
                            function(listaSumariosDataAluno) {
                                for (x = 0; x < listaSumariosDataAluno.disciplinas.length; x++) {
                                    var row = listaSumariosDataAluno.disciplinas[x];
                                    var sumarios =
                                        '<tr id="linha" class="table-light">' +
                                        '<td class="text-center align-middle" id="licao">' + row
                                        .licao + '</td>' +
                                        '<td class="text-center align-middle" id="dataaula">' + row
                                        .dataaula + '</td>' +
                                        '<td class="text-center align-middle" id="turma_aluno">' + row
                                        .turma_aluno + '</td>' +
                                        '<td class="text-center align-middle" id="nomeAnimal">' +
                                        row.disciplina + '</td>' +
                                        '<td class="text-center align-middle" id="telefone">' +
                                        row.sumario + '</td>' +
                                        '</tr>';
                                    $('#novaPesquisa').find('tbody').append(sumarios);
                                }
                            });
                    });
                });
            </script>

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
                                        <div class="mb-1"> Data inicial </div><input type="date" class="form-group" id="dataInicioAluno" name="dataInicio">
                                        <div class="mb-1 mt-1"> Data Final </div><input type="date" class="form-group" id="dataFimAluno" name="dataFim">
                                        <div class="mb-1 mt-1">
                                            <input type="text" class="form-group" id="nomeAlunoData" name="nomeAlunoData" placeholder="Turma / Aluno">

                                            <button onclick="alterClass()" class="btn btn-outline-primary ml-3" id="procurarAlunoData" type="button">Procurar</button>
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

    <div class="container w-100 mt-4 mb-4 d-none" id="table_sumario">
        <table class="table w-100 table-striped table-primary table-bordered table-hover table-responsive mt-4" id="novaPesquisa">
            <thead>
                <tr>
                    <th scope="col" class="text-center ">Lição </th>
                    <th scope="col" class="text-center"> Data e Hora</th>
                    <th scope="col" class="text-center"> Turma / Aluno</th>
                    <th scope="col" class="text-center"> Disciplina</th>
                    <th scope="col" class="text-center"> Sumário</th>
                </tr>
            </thead>
            <tbody> </tbody>
        </table>
        <div class="d-flex flex-row-reverse">
            <button onclick="exportTableToExcel('novaPesquisa', 'sumarios')" class="btn btn-outline-primary ml-3" id="retroceder">Exportar Excel</button>
        </div>
    </div>
    <script>

        // Excel ****************************************************************
    function exportTableToExcel(tableId, filename = 'tabela_excel') {
        var wb = XLSX.utils.table_to_book(document.getElementById(tableId), { sheet: "Sheet JS" });
        var wbout = XLSX.write(wb, { bookType: 'xlsx', type: 'binary' });

    function s2ab(s) {
        var buf = new ArrayBuffer(s.length);
        var view = new Uint8Array(buf);
        for (var i = 0; i < s.length; i++) {
        view[i] = s.charCodeAt(i) & 0xFF;
        }
        return buf;
    }

        var blob = new Blob([s2ab(wbout)], { type: 'application/octet-stream' });

        var link = document.createElement('a');
        link.href = URL.createObjectURL(blob);
        link.download = filename + '.xlsx';
        link.click();
    }

    // altera a class
    function alterClass(){
        const tableClass = document.getElementById('table_sumario');
        
        tableClass.classList.remove('d-none');

    }

    </script>
    <script src="js/xlsx.full.min.js"></script>
    <script src="jquery/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script>
        setTimeout(function() {

            $("#mensagem").hide()

        }, 2000); 
</script>
</body>

</html>
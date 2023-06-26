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
        <h1>REGISTO DE UTILIZADORES</h1>
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
                            <form action="includes/APIescola.php?pedido=registaUtilizadores" method="POST">
                                <div class="controls">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input type="text" name="usernameU" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="password" class="form-control" name="passwordU">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nome</label>
                                                <input type="text" class="form-control" id="nome" name="nomeU">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" class="form-control" id="email" name="emailU">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tipo</label>
                                                <select name="tipoAdminU" id="tipoAdmin" class="form-control">
                                                    <option value="" selected>Tipo</option>
                                                    <option value="0">Professor</option>
                                                    <option value="1">Administrador</option>
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
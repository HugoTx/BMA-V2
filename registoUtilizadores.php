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
        <a href="entrada.php"><button class="btn btn-outline-secondary" id="retroceder">Retroceder</button></a>
    </div>

    <!-- FORMULÁRIO DE REGISTO -->

    <div class="container w-50 mt-5 mb-4 border border-5 ">
        <form action="includes/APIescola.php?pedido=registaUtilizadores" method="POST">

            <div class="form-group mt-4">
                <label class="col-sm-2 control-label fw-bold">Username</label>
                <input type="text" name="usernameU">
            </div>

            <div class="form-group mt-4">
                <label class="col-sm-2 control-label fw-bold">Password</label>
                <input type="password" class="form-group" name="passwordU">
            </div>

            <div class="form-group mt-4">
                <label class="col-sm-2 control-label fw-bold">Nome</label>
                <input type="text" class="form-group" id="nome" name="nomeU">
            </div>
            <div class="form-group mt-4">
                <label class="col-sm-2 control-label fw-bold">email</label>
                <input type="email" class="form-group" id="email" name="emailU">
            </div>

            <div class="form-group mt-4">
                <label class="col-sm-2 control-label fw-bold">Tipo</label>
                <select name="tipoAdminU" id="tipoAdmin" class="form-group">
                    <option value="" selected>Tipo</option>
                    <option value="0">Professor</option>
                    <option value="1">Administrador</option>
                </select>
            </div>

            <div class="text-center mb-2 mt-4">
                <button type="submit" class="btn btn-outline-primary w-100 p-2 text-uppercase">Registar</button>
            </div>

        </form>
        <div align="center"> <text id="mensagem"><?= $mensagem ?></text></div>
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
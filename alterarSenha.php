<?php
session_start();
if (!isset($_SESSION['boasVindas'])) {
    header('Location:index.php');
    exit();
}
$mensagem = $_SESSION['mensagem'];
$_SESSION['mensagem'] = '';
$tipoAdmin = $_SESSION['tipo'];
if ($tipoAdmin == 0) {
    $tipoAdmin = 'Professor';
} else {
    $tipoAdmin = 'Administrador';
}
$user = $_SESSION['user'];
$email = $_SESSION['email'];
$passUt = $_SESSION['passUt'];
$id = $_SESSION['id'];
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
        <h1>DADOS DE UTILIZADOR</h1>
    </div>
    <div class="row text-center">
        <a href="entrada.php"><button class="btn btn-outline-secondary mb-4" id="retroceder">Retroceder</button></a>
    </div>

    <!-- FORMULÁRIO DE DADOS -->

    <div class="container">
        <div class="row">
            <div class="col-lg-7 mx-auto">
                <div class="card mt-2 mx-auto p-4 bg-light">
                    <div class="card-body bg-light">
                        <div class="container">
                            <form action="includes/APIupdatePassword.php?pedido=newPassword" method="POST">
                                <div class="controls">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input type="text" name="usernameU" class="form-control"
                                                    value="<?= $user ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <p>
                                                    <label>Password Atual</label>
                                                    <input type="password" class="form-control" name="passwordU"
                                                        onkeyup="old(`<?php echo $passUt ?>`)" id="password" required><i
                                                        class="bi bi-eye-slash" id="togglePasswordActual"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nova Password</label>
                                                <input type="password" class="form-control" id="passwordNew"
                                                    name="passwordNew" onkeyup="check()"><i class="bi bi-eye-slash"
                                                    id="togglePasswordNew"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Confirmação Nova Password</label>
                                                <input type="password" class="form-control" id="passwordNew1"
                                                    name="passwordNew1" onkeyup="check()"><i class="bi bi-eye-slash"
                                                    id="togglePasswordNew1"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-6 d-none">
                                            <div class="form-group">
                                                <label>ID</label>
                                                <input type="password" class="form-control" id="id" name="id"
                                                    value="<?php echo $id ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <p class="mt-2"> - No mínimo 8 caracteres </p>



                                    <div class="col-md-12 d-flex flex-row-reverse mt-2 me-2  ">
                                        <button type="submit" class="btn btn-outline-primary pt-2 disabled"
                                            id="actualizar">Atualizar</button>
                                    </div>
                                    <div class="center mt-2">
                                        <p id="alertPassword"></p>
                                    </div>
                            </form>

                        </div>

                        <script src="jquery/jquery.min.js"></script>
                        <script src="js/bootstrap.bundle.min.js"></script>
                        <script src="js/script.js"></script>

</body>

</html>
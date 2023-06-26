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
                                                        onkeyup="old()" id="password"><i class="bi bi-eye-slash"
                                                        id="togglePasswordActual"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nova Password</label>
                                                <input type="password" class="form-control" id="passwordNew"
                                                    name="passwordNew" onkeyup="check()">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Confirmação Nova Password</label>
                                                <input type="password" class="form-control" id="passwordNew1"
                                                    name="passwordNew1" onkeyup="check()">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="center mt-2">
                                        <p id="alertPassword"></p>
                                    </div>

                                    <div class="col-md-12 d-flex flex-row-reverse mt-2 me-2  ">
                                        <button type="submit" class="btn btn-outline-primary pt-2">Atualizar</button>
                                    </div>

                            </form>

                        </div>

                        <script src="jquery/jquery.min.js"></script>
                        <script src="js/bootstrap.bundle.min.js"></script>
                        <script>
                            setTimeout(function () {

                                $("#erro").hide()

                            }, 2000);

                            const togglePassword = document.querySelector('#togglePasswordActual');
                            const password = document.querySelector('#password');

                            togglePassword.addEventListener('click', function () {
                                // toggle the type attribute
                                const type =
                                    password.getAttribute('type') === 'password' ? 'text' : 'password';
                                password.setAttribute('type', type);

                                // toggle the icon
                                this.classList.toggle('bi-eye');
                            });

                            var check = function () {
                                if (document.getElementById('passwordNew').value == document.getElementById('passwordNew1').value) {

                                    document.getElementById('alertPassword').style.color = '#8CC63E';
                                    document.getElementById('alertPassword').innerHTML = '<span><i class="fas fa-check-circle"></i>Match!</span>';
                                } else {
                                    document.getElementById('alertPassword').style.color = '#EE2B39';
                                    document.getElementById('alertPassword').innerHTML = '<span><i class="fas fa-exclamation-triangle"></i>Not Match</span>';

                                }
                            }

                            var old = function () {
                                var pass = `<?php echo $passUt; ?>`;
                                if (document.getElementById('password').value == pass) {
                                    console.log('Lindo serviço');
                                }
                            }



                        </script>
</body>

</html>
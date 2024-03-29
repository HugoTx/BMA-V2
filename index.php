<?php
session_start();
$erro = $_SESSION['erro'];
$_SESSION['erro'] = '';
error_reporting(E_ALL ^ E_WARNING);
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

    <section class="vh-100 color-background">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card" style="border-radius: 1rem;">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img src="imagens/bma/bonequito2.jpg" alt="login form" class="img-fluid"
                                    style="border-radius: 1rem 0 0 1rem;" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center border1">
                                <div class="card-body p-4 p-lg-5 text-black">
                                    <form method="POST" action="includes/APIescola.php?pedido=verificaFuncionario"
                                        class="user">
                                        <img src="imagens/bma/lira.jpg" class="rounded-circle mx-auto d-block lira mb-2"
                                            alt="lira" style="width:150px; height:150px">
                                        <div class="d-flex align-items-center mb-3 pb-1 center">
                                            <span class="h1 fw-bold mb-0">Escola de Música</span>
                                        </div>
                                        <div class="d-flex align-items-center mb-3 pb-1 center">
                                            <span class="h2 fw-bold mb-0">Banda Musical de Arouca</span>
                                        </div>
                                        <div class="form-outline mb-4">
                                            <input type="text" id="text" class="form-control form-control-lg"
                                                name="username" required
                                                oninvalid="setCustomValidity('Por favor, preencha este campo')"
                                                oninput="setCustomValidity('')" />
                                            <label class="form-label">Utilizador</label>
                                        </div>
                                        <div class="form-outline mb-4">
                                            <input type="password" id="passwordIndex"
                                                class="form-control form-control-lg" name="password" required
                                                oninvalid="setCustomValidity('Por favor, preencha este campo')"
                                                oninput="setCustomValidity('')" /><i class="bi bi-eye-slash"
                                                id="togglePasswordIndex"></i>
                                            <label class="form-label">Password</label>
                                        </div>
                                        <div class="pt-1 mb-4 center">
                                            <input type="submit" name="login"
                                                class="btn btn-outline-primary btn-lg btn-block text" value="Login" />
                                        </div>
                                        <div class="pt-1 mb-4 center">
                                            <text class="text-center" id="erro">
                                                <?= $erro ?>
                                            </text>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="jquery/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script>
        setTimeout(function () {

            $("#erro").hide()

        }, 2000);


        const togglePasswordIndex = document.querySelector('#togglePasswordIndex');
        const passwordIndex = document.querySelector('#passwordIndex');

        togglePasswordIndex.addEventListener('click', function () {
            // toggle the type attribute
            const type =
                passwordIndex.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordIndex.setAttribute('type', type);

            // toggle the icon
            this.classList.toggle('bi-eye');
        });
    </script>

</body>

</html>
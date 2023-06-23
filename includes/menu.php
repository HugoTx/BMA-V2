<?php
session_start();

if (!isset($_SESSION['boasVindas'])) {
        header('Location:index.php');
        exit();
}
$boasVindas = $_SESSION['boasVindas'];
$_SESSION['boasVindas'] = '';
$nomeProfessor = $_SESSION['nomeProfessor'];
$_SESSION['mensagem'] = '';
$id = $_SESSION['id'];

?>

<!--logo-->
<div
        class="container-fluid d-flex justify-content-between align-items-center text-uppercase text-white color-background">
        <a href="entrada.php"><img src="imagens/bma/bonequito2.jpg" alt="Logo" width="100" height="90"
                        class="d-inline-block align-text-center rounded-circle mt-2 mb-2"></a>
        Escola de Música - Banda Musical de Arouca

        <!-- redes sociais
        <div class="d-flex flex-row-reverse mt-1 me-2">
                <a class="" href="https://www.facebook.com/bandadearouca" target="_blank" role="button"><i
                                alt="logo facebook" class=" bi bi-facebook" style="color:aliceblue"></i></a>
                <a class="ms-2" href="https://www.instagram.com/banda.m.arouca/" target="_blank" role="button"><i
                                class=" bi bi-instagram" style="color:aliceblue"></i></a>
                <a class="ms-2" href="https://www.bandadearouca.com" target="_blank" role="button"><i
                                class=" bi bi-globe" style="color:aliceblue"></i></a>
        </div> -->
        <div class="d-flex flex-row-reverse mt-1 me-2">
                <div class="dropdown">
                        <button type="button" class="btn btn-outline-light dropdown-toggle" data-bs-toggle="dropdown">
                                <?= $nomeProfessor ?>
                        </button>
                        <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Link 1</a></li>
                                <li><a class="dropdown-item" href="#">Link 2</a></li>
                                <li><a class="dropdown-item text-capitalize" href="logout.php">Logout</a>

                                </li>
                        </ul>
                </div>
        </div>
</div>

</div>
<div class="d-flex flex-row-reverse mt-1 me-2">
        <?= date("d-m-Y") ?>
</div>
<div class="back"></div>
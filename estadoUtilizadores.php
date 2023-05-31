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
    require("includes/connection.php");
    ?>

    <div class="text-center mt-2">
        <h1>LISTAGEM DE UTILIZADORES</h1>
    </div>
    <div class="row text-center">
        <a href="entrada.php"><button class="btn btn-outline-secondary" id="retroceder">Retroceder</button></a>
    </div>
    <?php
    $sqlestado = 'SELECT nome, estado, id FROM users';
    $sthestado = $dbh->prepare($sqlestado);
    $sthestado->execute();
    ?>

    <div align="center"> <text id="mensagem"><?= $mensagem ?></text></div>
    <div class="container w-100 mt-4 mb-4 ">
        <table class="table w-100 table-striped table-primary table-bordered table-hover table-responsive mt-4" id="novaPesquisa">
            <thead>
                <tr>
                    <th scope="col" class="text-center ">Nome </th>
                    <th scope="col" class="text-center">Estado</th>

                </tr>
            </thead>
            <tbody>
                <?php
                while ($estado = $sthestado->fetchObject()) {
                ?>
                    <tr>
                        <td><?= $estado->nome ?></td>
                        <?php if ($estado->estado == 1) { ?>
                            <td align="center"><a class="btn btn-outline-danger " href="includes/APIescola.php?pedido=inativaUser&id=<?= $estado->id ?>">Inativar</a></td>
                        <?php } else {
                        ?>
                            <td align="center"><a class="btn btn-outline-success" href="includes/APIescola.php?pedido=ativaUser&id=<?= $estado->id ?>">Activar</a></td>
                        <?php } ?>

                    </tr>
                <?php } ?>
            </tbody>
        </table>
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
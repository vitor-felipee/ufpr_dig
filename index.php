<?php
include("connection.php");

$mensagem = "";

session_start();
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header("Location: login.php");
    exit;
}

$id = $_SESSION['id'];
$sql = "SELECT COUNT(*) as total_partidas, AVG(ppm) as media_ppm, AVG(precisao) as media_precisao, MAX(ppm) as maior_ppm, MAX(precisao) as maior_precisao FROM partidas WHERE id_usuario = '$id'";

if (!($dados = mysqli_query($conn, $sql))) {
    $mensagem = "<div class='alert alert-danger'>Erro ao carregar informações: " . mysqli_error($conn) . "</div>";
} else {
    $dados = mysqli_fetch_assoc($dados);
    $totalPartidas = $dados['total_partidas'];
    $mediaPPM = round($dados['media_ppm'], 2);
    $mediaPrecisao = round($dados['media_precisao'], 2);
    $maiorPPM = $dados['maior_ppm'];
    $maiorPrecisao = $dados['maior_precisao'];
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles/jogo.css">
    <title>UFPR DIG</title>
</head>

<body class="bg-dark text-light">
    <!-- Inclui o arquivo da barra de navegação -->
    <?php include "navbar.php"; ?>
    <div class="container mt-5">
        <?php echo $mensagem; ?>
        <div class="row g-4">
            <div class="col-md-12">
                <a href="jogo.php" class="btn btn-primary btn-lg w-100"> INICIAR PARTIDA</a>
            </div>
            <div class="col-md-4">
                <div class="card text-center text-dark bg-light p-3">
                    <h5>Total de Partidas</h5>
                    <h2>
                        <?php echo $totalPartidas; ?>
                    </h2>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center text-dark bg-light p-3">
                    <h5>Média de PPM</h5>
                    <h2>
                        <?php echo $mediaPPM; ?>
                    </h2>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center text-dark bg-light p-3">
                    <h5>Média de Precisão (%)</h5>
                    <h2>
                        <?php echo $mediaPrecisao; ?>
                    </h2>
                </div>
            </div>
            <?php if ($totalPartidas > 0) { ?>
                <div class="col-md-6">
                    <div class="card text-center text-dark bg-info p-3">
                        <h5>Maior PPM</h5>
                        <h2>
                            <?php echo $maiorPPM; ?>
                        </h2>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card text-center text-dark p-3" style="background-color: #b9fbc0;">
                        <h5>Maior Precisão (%)</h5>
                        <h2>
                            <?php echo $maiorPrecisao; ?>
                        </h2>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</body>

</html>
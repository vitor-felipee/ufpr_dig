<?php
include("connection.php");

$mensagem = "";

session_start();
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
  header("Location: login.php");
  exit;
}

$id = $_SESSION['id'];
$sql = "SELECT * FROM partidas WHERE id_usuario = '$id' ORDER BY data_partida desc LIMIT 100";

if (!($partidas = mysqli_query($conn, $sql))) {
  $mensagem = "<div class='alert alert-danger'>Erro ao buscar partidas: " . mysqli_error($conn) . "</div>";
} else {
  if (mysqli_num_rows($partidas) === 0) {
    $mensagem = "<div class='alert alert-primary'>Não há nenhuma partida registrada</div>";
  }
}
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
    <div class="row">
      <div class="col-md-10 offset-md-1">
        <?php echo $mensagem ?>
        <?php if (mysqli_num_rows($partidas) > 0) { ?>
          <h1 class="text-center p-2  mb-5">Histórico de Partidas</h1>
          <table class="table border border-4">
            <thead>
              <tr>
                <th>Data</th>
                <th>PPM</th>
                <th>Precisão</th>
                <th>Acertos</th>
                <th>Erros</th>
              </tr>
            </thead>
            <tbody>
              <?php while ($partida = mysqli_fetch_assoc($partidas)) { ?>
                <tr>
                  <td>
                    <?php echo date('d/m/Y H:i', strtotime($partida['data_partida'])); ?>
                  </td>
                  <td>
                    <?php echo $partida['ppm']; ?>
                  </td>
                  <td>
                    <?php echo $partida['precisao'] . "%"; ?>
                  </td>
                  <td>
                    <?php echo $partida['acertos']; ?>
                  </td>
                  <td>
                    <?php echo $partida['erros'] ?>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        <?php } ?>
      </div>
    </div>
  </div>
</body>

</html>
<?php
session_start();
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
  header("Location: login.php");
  exit;
}

if (!isset($_GET['liga'])) {
  header("Location: ligas.php");
  exit;
}

include("connection.php");
$mensagem = "";

$idLiga = (int)$_GET['liga'];
$sql = "SELECT nome from ligas where id = $idLiga";
if (!($nomeLiga = mysqli_query($conn, $sql))) {
  $mensagem = "<div class='alert alert-danger'>Erro ao buscar nome da liga: " . mysqli_error($conn) . "</div>";
} else {
  $tipo_ranking = isset($_GET['tipo']) ? $_GET['tipo'] : 'geral';
  $nomeLiga = mysqli_fetch_assoc($nomeLiga)['nome'];

  $sql = "SELECT u.nome, 
        ROUND(AVG(p.ppm)) as media_ppm, 
        ROUND(AVG(p.precisao)) as media_precisao,
        COUNT(p.id) as total_partidas
        FROM partidas p
        INNER JOIN usuarios u ON p.id_usuario = u.id
        INNER JOIN membrosLigas ml ON ml.id_usuario = u.id
        INNER JOIN ligas l ON l.id = ml.id_liga
        WHERE ml.id_liga = $idLiga AND p.data_partida >= l.data_criacao";


  if ($tipo_ranking == 'semanal') {
    $data_limite = date('Y-m-d H:i:s', strtotime('-7 days'));

    $sql .= " AND p.data_partida >= '$data_limite' ";
  }

  $sql .= " GROUP BY u.id ORDER BY media_ppm DESC, media_precisao desc, total_partidas desc";

  if (!($resultado = mysqli_query($conn, $sql))) {
    $mensagem = "<div class='alert alert-danger'>Erro ao buscar informações dos usuários da liga: " . mysqli_error($conn) . "</div>";
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
        <h2 class="text-center fs-1 p-2 mb-5">Classificação dos Jogadores da Liga <?php echo $nomeLiga ?></h2>
        <div class="d-flex justify-content-center mb-5">
          <div class="btn-group">
            <a href="<?php echo $_SERVER['PHP_SELF'] ?>?liga=<?php echo $idLiga; ?>&tipo=geral" class="btn btn-outline-primary <?php echo ($tipo_ranking == 'geral') ? 'active' : ''; ?>">Geral</a>
            <a href="<?php echo $_SERVER['PHP_SELF'] ?>?liga=<?php echo $idLiga; ?>&tipo=semanal" class="btn btn-outline-primary <?php echo ($tipo_ranking == 'semanal') ? 'active' : ''; ?>">Semanal</a>
            <a href="ligas.php" class="btn btn-outline-primary">Voltar</a>
          </div>
        </div>
        <?php if (mysqli_num_rows($resultado) > 0) { ?>
          <table class="table border border-4">
            <thead>
              <tr>
                <th>Posição</th>
                <th>Jogador</th>
                <th>Média PPM</th>
                <th>Média Precisão</th>
                <th>Partidas Jogadas</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $posicao = 1;
              while ($usuario = mysqli_fetch_assoc($resultado)) { ?>
                <tr>
                  <td>
                    <?php echo $posicao; ?>
                  </td>
                  <td>
                    <?php echo $usuario['nome']; ?>
                  </td>
                  <td>
                    <?php echo $usuario['media_ppm']; ?>
                  </td>
                  <td>
                    <?php echo $usuario['media_precisao']; ?>%
                  </td>
                  <td>
                    <?php echo $usuario['total_partidas']; ?>
                  </td>
                </tr>
              <?php $posicao++;
              } ?>
            </tbody>
          </table>
        <?php } else { ?>
          <div class="alert alert-info text-center">Nenhum jogador classificado neste período.</div>
        <?php } ?>
      </div>
    </div>
  </div>

</body>

</html>
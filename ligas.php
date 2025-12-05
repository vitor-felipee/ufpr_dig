<?php
session_start();
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
  header("Location: login.php");
  exit;
}

include("connection.php");
$mensagemCriar = "";
$mensagemEntrar = "";
$mensagemMinhasLigas = "";
$mensagemLigas = "";
$entrarLiga = "";

$idUsuario = (int)$_SESSION['id'];

if (isset($_POST['btn_criar'])) {
  if (empty($_POST['nome']) || empty($_POST['senha'])) {
    $mensagemCriar = "<div class='alert alert-warning'>Preencha todos os campos!</div>";
  } else {
    $nome = mysqli_real_escape_string($conn, $_POST['nome']);
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $sql = "SELECT id FROM ligas WHERE nome = '$nome'";

    if ((!$ligaExiste = mysqli_query($conn, $sql))) {
      $mensagemCriar = "<div class='alert alert-danger'>Erro ao verificar liga: " . mysqli_error($conn) . "</div>";
    } else if (mysqli_num_rows($ligaExiste) > 0) {
      $mensagemCriar = "<div class='alert alert-warning'>Já existe uma liga com esse nome.</div>";
    } else {
      $sql = "INSERT INTO ligas(nome, id_dono, palavra_chave) values ('$nome', $idUsuario, '$senha')";

      if (!(mysqli_query($conn, $sql))) {
        $mensagemCriar = "<div class='alert alert-danger'>Erro ao cadastrar liga: " . mysqli_error($conn) . "</div>";
      } else {
        $idLiga = mysqli_insert_id($conn);
        $sql = "INSERT INTO membrosLigas(id_usuario, id_liga) values ($idUsuario, $idLiga)";
        if (!(mysqli_query($conn, $sql))) {
          $mensagemCriar = "<div class='alert alert-danger'>Erro ao adicionar usuário na liga: " . mysqli_error($conn) . "</div>";
        } else {
          $mensagemCriar = "<div class='alert alert-success'>Você criou a liga com sucesso!</div>";
        }
      }
    }
  }
} else if (isset($_POST['btn_entrar'])) {
  if (empty($_POST['nome']) || empty($_POST['senha'])) {
    $mensagemEntrar = "<div class='alert alert-warning'>Preencha nome e senha!</div>";
  } else {
    $nome = mysqli_real_escape_string($conn, $_POST['nome']);
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM ligas where nome = '$nome'";

    if (!($dadosLiga = mysqli_query($conn, $sql))) {
      $mensagemEntrar = "<div class='alert alert-danger'>Erro ao buscar informações da liga: " . mysqli_error($conn) . "</div>";
    } else {
      if (mysqli_num_rows($dadosLiga) === 0) {
        $mensagemEntrar = "<div class='alert alert-danger'>Não existe liga com esse nome.</div>";
      } else {
        $dadosLiga = mysqli_fetch_assoc($dadosLiga);
        $idLiga = (int)$dadosLiga['id'];
        if (!(password_verify($senha, $dadosLiga['palavra_chave']))) {
          $mensagemEntrar = "<div class='alert alert-danger'>Senha Incorreta</div>";
        } else {
          $sql = "SELECT * FROM membrosLigas WHERE id_usuario = $idUsuario AND id_liga = $idLiga";
          if (!($usuarioEstaLiga = mysqli_query($conn, $sql))) {
            $mensagemEntrar = "<div class='alert alert-danger'>Erro ao verificar participação: " . mysqli_error($conn) . "</div>";
          } elseif (mysqli_num_rows($usuarioEstaLiga) > 0) {
            $mensagemEntrar = "<div class='alert alert-warning'>Você já está nessa liga!</div>";
          } else {
            $sql = "INSERT INTO membrosLigas(id_usuario, id_liga) values ($idUsuario, $idLiga)";
            if (!(mysqli_query($conn, $sql))) {
              $mensagemEntrar = "<div class='alert alert-danger'>Erro ao adicionar usuário na liga: " . mysqli_error($conn) . "</div>";
            } else {
              $mensagemEntrar = "<div class='alert alert-success'>Você entrou na liga com sucesso!</div>";
            }
          }
        }
      }
    }
  }
} else if (isset($_GET['entrarLiga'])) {
  $entrarLiga = $_GET['entrarLiga'];
}

$sql = "SELECT ligas.nome, ligas.id FROM ligas, membrosLigas WHERE membrosLigas.id_usuario = $idUsuario AND membrosLigas.id_liga = ligas.id";
if (!($ligasUsuario = mysqli_query($conn, $sql))) {
  $mensagemMinhasLigas = "<div class='alert alert-danger'>Erro ao buscar suas ligas: " . mysqli_error($conn) . "</div>";
} else {
  if (mysqli_num_rows($ligasUsuario) === 0) {
    $mensagemMinhasLigas = "<div class='alert alert-primary'>Você ainda não está em nenhuma liga.</div>";
  }
}

$sql = "SELECT ligas.nome FROM ligas";
if (!($ligasNome = mysqli_query($conn, $sql))) {
  $mensagemLigas = "<div class='alert alert-danger'>Erro ao buscar todas as ligas: " . mysqli_error($conn) . "</div>";
} else {
  if (mysqli_num_rows($ligasNome) === 0) {
    $mensagemLigas = "<div class='alert alert-primary'>Ainda não há nenhuma liga cadastrada.</div>";
  }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <title>UFPR DIG - Ligas</title>
</head>

<body class="bg-dark text-light">
  <?php include "navbar.php"; ?>
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-12 m-2 p-4 border border-primary">
        <h2 class="fs-2 mb-3 text-center">Listagem de Ligas</h2>
        <?php echo $mensagemLigas; ?>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
          <?php while ($ligaNome = mysqli_fetch_assoc($ligasNome)) { ?>
            <a href="<?php echo $_SERVER['PHP_SELF'] ?>?entrarLiga=<?php echo $ligaNome['nome']; ?>" class="btn bg-light text-primary border border-primary">
              <?php echo $ligaNome['nome']; ?>
            </a>
          <?php } ?>
        </div>
      </div>
      <div class="col-md-3 m-3 p-4 border border-primary">
        <h2 class="fs-1 text-center">Minhas Ligas</h2>
        <p class="text-center">Clique nelas para visualizar a classificação</p>
        <?php echo $mensagemMinhasLigas; ?>
        <div class="list-group">
          <?php while ($ligaUsuario = mysqli_fetch_assoc($ligasUsuario)) { ?>
            <a href="verLiga.php?liga=<?php echo $ligaUsuario['id']; ?>" class="list-group-item list-group-item-action">
              <?php echo $ligaUsuario['nome']; ?>
            </a>
          <?php } ?>
        </div>
      </div>
      <div class="col-md-4 p-4 m-3 border border-primary">
        <h2 class="fs-1 text-center mb-4">Criar Liga</h2>
        <?php if ($mensagemCriar) {
          echo $mensagemCriar;
        } ?>
        <form class="form d-flex flex-column" action="ligas.php" method="POST">
          <label class="mb-2" for="nome">Nome</label>
          <input class="form-control mb-2" type="text" name="nome" id="nome" required>
          <label class="mb-2" for="senha">Senha</label>
          <input class="form-control mb-2" type="password" name="senha" id="senha" required>
          <input class="btn btn-primary mt-4 mb-2" type="submit" name="btn_criar" value="Criar">
        </form>
      </div>
      <div class="col-md-4 p-4 ms-3 my-3 border border-primary">
        <h2 class="fs-1 text-center mb-4">Entrar Liga</h2>
        <?php if ($mensagemEntrar) {
          echo $mensagemEntrar;
        } ?>
        <form class="form d-flex flex-column" action="ligas.php" method="POST">
          <label class="mb-2" for="nome">Nome</label>
          <input class="form-control mb-2" type="text" name="nome" id="nome" value="<?php echo $entrarLiga; ?>" required>
          <label class="mb-2" for="senha">Senha</label>
          <input class="form-control mb-2" type="password" name="senha" id="senha" required>
          <input class="btn btn-primary mt-4 mb-2" type="submit" name="btn_entrar" value="Entrar">
        </form>
      </div>
    </div>
  </div>
</body>


</html>
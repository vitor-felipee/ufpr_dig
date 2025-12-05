<?php
session_start();
include("connection.php");

if (!isset($_POST['email']) || empty($_POST['email'])) {
  header("Location: login.php");
  exit;
}

$email = mysqli_real_escape_string($conn, $_POST['email']);
$senha = $_POST['senha'];

$sql = "SELECT * FROM usuarios where email = '$email'";
$resultado = mysqli_query($conn, $sql);

if (!$resultado) {
  $_SESSION['erro_login'] = "Erro ao buscar usuário: " . mysqli_error($conn);
  header("Location: login.php");
  exit;
}

if (mysqli_num_rows($resultado) > 0) {
  $usuario = mysqli_fetch_assoc($resultado);
  if (password_verify($senha, $usuario['senha'])) {
    $_SESSION['logado'] = true;
    $_SESSION['id'] = $usuario['id'];
    $_SESSION['nome'] = $usuario['nome'];
    header("Location: index.php");
    exit();
  } else {
    $_SESSION['erro_login'] = "Usuário ou senha incorreto.";
    header("Location: login.php");
    exit;
  }
} else {
  $_SESSION['erro_login'] = "E-mail não encontrado.";
  header("Location: login.php");
  exit;
}

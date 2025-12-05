<?php
session_start();
include("connection.php");

if (!isset($_POST['nome']) || empty($_POST['nome'])) {
  header("Location: registro.php");
  exit;
}

$nome = mysqli_real_escape_string($conn, $_POST['nome']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$senha = $_POST['senha'];
$confirmarSenha = $_POST['confirmarSenha'];

if ($senha !== $confirmarSenha) {
  $_SESSION['msg_registro'] = "<div class='alert alert-danger'>As senhas não são iguais!</div>";
  header("Location: registro.php");
  exit;
}

$sql = "SELECT COUNT(*) FROM usuarios WHERE email = '$email'";
if ($emailExiste = mysqli_query($conn, $sql)) {
  if (mysqli_num_rows($emailExiste) === 0) {
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
    $sql = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senhaHash')";
    if (mysqli_query($conn, $sql)) {
      $_SESSION['msg_registro'] = "<div class='alert alert-success'>Usuário cadastrado com sucesso! <a href='login.php' class='alert-link'>Faça Login</a></div>";
      header("Location: registro.php");
      exit;
    } else {
      $_SESSION['msg_registro'] = "<div class='alert alert-danger'>Erro ao cadastrar: " . mysqli_error($conn) . "</div>";
      header("Location: registro.php");
      exit;
    }
  } else {
    $_SESSION['msg_registro'] = "<div class='alert alert-danger'>Erro inesperado ao cadastrar: " . mysqli_error($conn) . "</div>";
    header("Location: registro.php");
    exit;
  }
} else {
  $_SESSION['msg_registro'] = "<div class='alert alert-danger'>Erro inesperado ao cadastrar: " . mysqli_error($conn) . "</div>";
  header("Location: registro.php");
  exit;
}

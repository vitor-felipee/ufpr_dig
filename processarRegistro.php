<?php
session_start();
include("connection.php");

if (!isset($_POST['nome']) || empty($_POST['nome']) || !isset($_POST['email']) || empty($_POST['email'])) {
  $_SESSION['msg_registro'] = "<div class='alert alert-danger'>Houve um erro inesperado.</div>";
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

$sql = "SELECT * FROM usuarios WHERE email = '$email' LIMIT 1";
$result = mysqli_query($conn, $sql);

if (!$result) {
  $_SESSION['msg_registro'] = "<div class='alert alert-danger'>Erro ao verificar email: " . mysqli_error($conn) . "</div>";
  header("Location: registro.php");
  exit;
}

if (mysqli_num_rows($result) > 0) {
  $_SESSION['msg_registro'] = "<div class='alert alert-danger'>Email já cadastrado!</div>";
  header("Location: registro.php");
  exit;
}

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

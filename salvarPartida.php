<?php
include("connection.php");
session_start();
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
  echo json_encode(["sucesso" => false, "erro" => "Usuário nao logado"]);
  exit;
}

$json = file_get_contents("php://input");
$dados = json_decode($json, true);

if ($dados) {
  $idUsuario = $_SESSION['id'];

  $ppm = (int)$dados['velocidade'];
  $precisao = (int)$dados['precisao'];
  $acertos = (int)$dados['acertos'];
  $erros = (int)$dados['erros'];

  if ($ppm < 0 || $precisao < 0 || $acertos < 0 || $erros < 0) {
    echo json_encode(["sucesso" => false, "erro" => "Dados inválidos (valores negativos)"]);
    exit;
  }

  if (abs($ppm - $acertos / 5) > 10 || $ppm > 300) {
    echo json_encode(["sucesso" => false, "erro" => "Dados inválidos (velocidade incomum)"]);
    exit;
  }

  $sql = "INSERT INTO partidas(id_usuario, ppm, precisao, acertos, erros, data_partida) values ($idUsuario, $ppm, $precisao, $acertos, $erros, now())";

  if (mysqli_query($conn, $sql)) {
    echo json_encode(["sucesso" => true]);
  } else {
    echo json_encode(["sucesso" => false, "erro" => mysqli_error($conn)]);
  }
} else {
  echo json_encode(["sucesso" => false, "erro" => "Nenhum dado recebido"]);
}

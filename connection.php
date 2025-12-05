<?php
include("credentials.php");

$conn = mysqli_connect($server, $usuario, $password, $db);
if (!$conn) {
  die("Falha na conexão: " . mysqli_connect_error());
}

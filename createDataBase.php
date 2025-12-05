<?php
include("credentials.php");

$conn = mysqli_connect($server, $usuario, $password);

if (!$conn) {
    die("Falha na conexão: " . mysqli_connect_error());
}
echo "Conectado ao Banco de Dados com sucesso.";

$sql = "CREATE DATABASE IF NOT EXISTS ufpr_dig";
if (mysqli_query($conn, $sql)) {
    echo "Banco de dados criado ou já existente.";
} else {
    die("Erro ao criar banco de dados: " . mysqli_error($conn));
}
mysqli_select_db($conn, "ufpr_dig");

$sqlUsuarios = "CREATE TABLE IF NOT EXISTS usuarios (
    id int UNSIGNED AUTO_INCREMENT primary key,
    nome varchar(100) not null,
    email varchar(100) not null unique,
    senha varchar(255) NOT NULL,
    dataCadastro DATETIME default CURRENT_TIMESTAMP
)";

if (!(mysqli_query($conn, $sqlUsuarios))) {
    die("Erro na criação da tabela usuarios: " . mysqli_error($conn));
}

$sqlPartidas = "CREATE TABLE IF NOT EXISTS partidas (
    id int UNSIGNED AUTO_INCREMENT primary key,
    id_usuario int UNSIGNED not null,
    ppm int not null,
    precisao int not null,
    acertos int not null,
    erros int not null,
    data_partida DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
)";

if (!(mysqli_query($conn, $sqlPartidas))) {
    die("Erro na criação da tabela partidas: " . mysqli_error($conn));
}

$sqlLigas = "CREATE TABLE IF NOT EXISTS ligas (
    id INT UNSIGNED AUTO_INCREMENT primary key,
    nome VARCHAR(100) not null unique,
    palavra_chave VARCHAR(255) not null,
    id_dono int UNSIGNED not null,
    data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_dono) REFERENCES usuarios(id)
)";

if (!(mysqli_query($conn, $sqlLigas))) {
    die("Erro na criação da tabela ligas: " . mysqli_error($conn));
}

$sqlMembros = "CREATE TABLE IF NOT EXISTS membrosLigas (
    id int UNSIGNED AUTO_INCREMENT primary key,
    id_usuario INT UNSIGNED not null,
    id_liga INT UNSIGNED not null,
    data_entrada DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id),
    FOREIGN KEY (id_liga) REFERENCES ligas(id)
)";

if (!(mysqli_query($conn, $sqlMembros))) {
    die("Erro na criação da tabela membrosLigas: " . mysqli_error($conn));
}

mysqli_close($conn);

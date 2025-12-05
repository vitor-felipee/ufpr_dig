<?php
session_start();
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header("Location: login.php");
    exit;
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
                <!-- Área de status do jogo: mostra tempo, PPM, precisão, acertos e erros-->
                <div id="status-area" class="row mb-3">
                    <div class="col text-center">
                        <p class="fs-3 m-0">Tempo</p>
                        <p class="fs-2 fw-bold" id="tempo">60</p>
                    </div>
                    <div class="col text-center">
                        <p class="fs-3 m-0">PPM</p>
                        <p class="fs-2 fw-bold" id="velocidade">0</p>
                    </div>
                    <div class="col text-center">
                        <p class="fs-3 m-0">Precisão</p>
                        <p class="fs-2 fw-bold" id="precisao">0%</p>
                    </div>
                    <div class="col text-center">
                        <p class="fs-3 m-0">Acertos</p>
                        <p class="fs-2 fw-bold" id="acertos">0</p>
                    </div>
                    <div class="col text-center">
                        <p class="fs-3 m-0">Erros</p>
                        <p class="fs-2 fw-bold" id="erros">0</p>
                    </div>
                </div>

                <!-- Area do jogo: onde as palavras vão aparecer e o usuário digitará -->
                <div id="jogo-area" class="mb-4">
                    <div id="quadro-palavras" class="border border-2 border-light p-2 px-3 fs-4 rounded-4 mb-4">
                        <p class="paragrafo-quadro">Carregando jogo...</p>
                    </div>
                    <div>
                        <!-- Input para o usuário digitar as palavras -->
                        <input id="input-digitacao" class="form-control form-control-lg" type="text" placeholder="Digite aqui...">
                    </div>
                </div>


                <!-- Área do resultado - exibida quando o jogo termina, inicialmente oculta -->
                <div id="resultado-area" class="row py-4  border border-2 rounded-4 d-none">
                    <h2 class="text-center mb-4">FIM DE JOGO</h2>
                    <div class="row">
                        <div class="col text-center">
                            <p class="fs-3 m-0">PPM</p>
                            <p class="fs-2 fw-bold" id="velocidade-final">0</p>
                        </div>
                        <div class="col text-center">
                            <p class="fs-3 m-0">Precisão</p>
                            <p class="fs-2 fw-bold" id="precisao-final">0%</p>
                        </div>
                        <div class="col text-center">
                            <p class="fs-3 m-0">Acertos</p>
                            <p class="fs-2 fw-bold" id="acertos-final">0</p>
                        </div>
                        <div class="col text-center">
                            <p class="fs-3 m-0">Erros</p>
                            <p class="fs-2 fw-bold" id="erros-final">0</p>
                        </div>
                    </div>

                    <!-- Botão para reiniciar o jogo -->
                    <button id="btn-jogar-novamente" class="btn btn-primary w-50 btn-lg mx-auto mt-2 fs-4">Jogar novamente</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Importa lógica do jogo -->
    <script src="scripts/jogo.js"></script>
</body>

</html>
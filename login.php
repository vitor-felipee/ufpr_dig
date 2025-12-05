<?php
session_start();
if (isset($_SESSION['logado']) && $_SESSION['logado'] === true) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>UFPR DIG - Login</title>
</head>

<body class="bg-dark d-flex justify-content-center align-items-center vh-100">
    <div class="bg-light col-md-4 p-5 card border border-4">
        <h2 class="fs-1 text-center mb-4">Login</h2>
        <?php
        if (isset($_SESSION['erro_login'])) {
            echo "<div class='alert alert-danger'>" . $_SESSION['erro_login'] . "</div>";
            unset($_SESSION['erro_login']);
        }
        ?>
        <form class="form d-flex flex-column" action="processarLogin.php" method="POST">
            <label class="mb-2" for="email">E-mail</label>
            <input class="form-control mb-2" type="email" name="email" id="email" required>
            <label class="mb-2" for="senha">Senha</label>
            <input class="form-control mb-2" type="password" name="senha" id="senha" required>
            <input class="btn btn-primary mt-4 mb-2" type="submit" value="Entrar">
        </form>
        <p class="text-center mb-2">Não tem conta? <a href="registro.php">Registre-se</a></p>
    </div>
</body>

</html>
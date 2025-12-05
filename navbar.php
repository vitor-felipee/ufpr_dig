<?php
if (!isset($_SESSION)) {
    session_start();
}
?>

<!-- Barra de navegação principal -->
<nav class="navbar bg-light px-4">
    <div class="container-fluid">
        <!-- Logo ou nome do sistema -->
        <a class="navbar-brand fs-4 me-5" href="index.php">UFPR DIG</a>
        <!-- Lista de links de navegação -->
        <ul class="navbar-nav d-flex flex-row me-auto">
            <!-- Cada <li> é um item da barra de navegação -->
            <li class="nav-item me-4">
                <a class="nav-link fs-5" href="index.php">Início</a>
            </li>
            <li class="nav-item me-4">
                <a class="nav-link fs-5" href="jogo.php">Jogar</a>
            </li>
            <li class="nav-item me-4">
                <a class="nav-link fs-5" href="ligas.php">Ligas</a>
            </li>
            <li class="nav-item me-4">
                <a class="nav-link fs-5" href="classificacao.php">Classificação</a>
            </li>
            <li class="nav-item me-4">
                <a class="nav-link fs-5" href="historico.php">Meu Histórico</a>
            </li>
        </ul>
        <!-- Mensagem ao usuário e botão de logout -->
        <div class="d-flex align-items-center">
            <span class="text-dark fs-5 me-3">Olá,
                <?php echo $_SESSION['nome']; ?>
            </span>
            <a href="logout.php" class="btn btn-danger">Sair</a>
        </div>

    </div>

</nav>
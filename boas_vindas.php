<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Exercício 4 - Desafio (Boas-vindas)</title>
</head>
<body>
    <h1>Exercício 4 - Boas-vindas</h1>

    <?php
    if (isset($_SESSION["nome"])) {
        $nome = htmlspecialchars($_SESSION["nome"]);
        echo "<p>Bem-vindo(a), $nome!</p>";
    } else {
        echo '<p>Você ainda não fez login. <a href="exer04.html">Ir para o login</a>.</p>';
    }
    ?>
</body>
</html>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Resultado - Exercício 1</title>
</head>
<body>
    <?php
    $nome = htmlspecialchars($_GET["nome"]);
    $cidade = htmlspecialchars($_GET["cidade"]);

    echo "<p>Olá, $nome! Você mora em $cidade.</p>";
    ?>
</body>
</html>

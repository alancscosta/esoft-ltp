<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Resultado - Exercício 2</title>
</head>
<body>
    <?php
    $nome = htmlspecialchars($_POST["nome"]);
    $cidade = htmlspecialchars($_POST["cidade"]);

    echo "<p>Olá, $nome! Você mora em $cidade.</p>";

    if (strtolower($_POST["cidade"]) == "curitiba") {
        echo "<p>Curitibano!</p>";
    }
    ?>
</body>
</html>

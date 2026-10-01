<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Resultado - Exercício 3</title>
</head>
<body>
    <?php
    $numero1 = (float) $_POST["numero1"];
    $numero2 = (float) $_POST["numero2"];
    $soma = $numero1 + $numero2;

    print "<p>A soma é: $soma</p>";

    echo "<p>Tipos dos valores:</p>";
    var_dump($numero1);
    echo "<br>";
    var_dump($numero2);
    echo "<br>";
    var_dump($soma);
    ?>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

    //array associativo

    $pessoa = [
        "nome" => "Lucas",
        "idade" => 20,
        "cidade" => "Friburgo"
    ];

    echo $pessoa["nome"];   // Lucas
    echo "\n";
    echo $pessoa["cidade"]; // Friburgo


    //varrendo um array associativo ou com chave

    $pessoa = [
        "nome" => "Ana",
        "idade" => 30,
        "cidade" => "Niterói"
    ];

    foreach ($pessoa as $chave => $valor) { //varrer=foreach
        echo "$chave: $valor\n";
    }
    ?>

    <!--Get-->
                <!--arquivo php-->
    <form action="resposta_get.php" method="GET">
    Nome: <input type="text" name="nome"><br>
    Idade: <input type="number" name="idade"><br>
    <input type="submit" value="Enviar">
    </form>

    <?php   //isso fica em um arquivo php
    if (isset($_GET["nome"]) && isset($_GET["idade"])) {
        echo "Nome: " . $_GET["nome"] . "<br>";
        echo "Idade: " . $_GET["idade"];
    } else {
        echo "Dados não enviados.";
    }
    ?>
    <!--Para fazer o POST basta trocar todos os gets por post e pronto. A diferença entre eles é que o POST não mostra as infos na url-->
    <!--Usar isset junto para ver se o campo foi preenchido-->    



    <!--Exemplo de retroalimentação-->
    <h1>Somador de valores</h1>
    <?php
        //capturando os dados do Formulário Retroalimentado
        $valor1 = $_GET['v1'] ?? 0;
        $valor2 = $_GET['v2'] ?? 0;
    ?>

    <form action="<?=$_SERVER['PHP_SELF']?>" method="get">
        <label for="v1">Valor 1</label>
        <input type="number" name="v1" id="v1" value="<?=$valor1?>">
        <label for="v2">Valor 2</label>
        <input type="number" name="v2" id="v2" value="<?=$valor2?>">
        <input type="submit" value="Somar">
    </form>
    <!-- Fazendo isso o formulário se retroalimenta, sem precisar mandar as informações para outra página -->
     <section id="resultado">
        <h2>resultado da soma</h2>
        <?php
            $soma = $valor1 + $valor2;
            echo "<p>A soma os valores $valor1 e $valor2 é: ".$soma;
        ?>
     </section>

</body>
</html>
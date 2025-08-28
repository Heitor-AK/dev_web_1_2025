<?php
session_start();

if (!isset($_SESSION["email"])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $veiculo = [
        "modelo" => $_POST["modelo"],
        "montadora" => $_POST["montadora"],
        "motor" => $_POST["motor"],
        "combustivel" => $_POST["combustivel"],
        "lugares" => $_POST["lugares"],
        "bagageiro" => $_POST["bagageiro"],
        "preco" => $_POST["preco"]
    ];

    $email = $_SESSION["email"];

    if (!isset($_SESSION["veiculos"][$email])) {
        $_SESSION["veiculos"][$email] = [];
    }

    $_SESSION["veiculos"][$email][] = $veiculo;
    header("Location: listar.php");
    exit;
}
?>

<h2>Cadastro de Veículo</h2>
<p>Usuário logado: <?= $_SESSION["email"] ?></p>

<form method="post">
    Modelo: <input type="text" name="modelo" required><br><br>
    Montadora:
    <select name="montadora">
        <option>Honda</option><option>Chevrolet</option><option>Peugeot</option>
        <option>Volkswagen</option><option>Fiat</option><option>Toyota</option>
        <option>BYD</option><option>Outros</option>
    </select><br><br>

    Tipo de Motor:
    <select name="motor">
        <option>1.0</option><option>1.4</option><option>1.6</option>
        <option>2.0</option><option>Elétrico</option><option>Outros</option>
    </select><br><br>

    Tipo de Combustível:
    <select name="combustivel">
        <option>Flex</option><option>Gasolina</option><option>Álcool</option>
        <option>Diesel</option><option>Elétrico</option>
    </select><br><br>

    Número de lugares: <input type="number" name="lugares" required><br><br>
    Litragem do bagageiro: <input type="number" name="bagageiro" required><br><br>
    Preço do veículo: <input type="number" step="0.01" name="preco" required><br><br>

    <button type="submit">Cadastrar Veículo</button>
</form>

<br>
<a href="listar.php">Ir para listagem de veículos</a>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
session_start(); // Inicia a sessão para poder usar a variável $_SESSION

// Inicializa o array de produtos se ainda não estiver definido
if (!isset($_SESSION["produtos"])) {
    $_SESSION["produtos"] = [];
}

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validação dos campos (mínima, apenas checar se estão preenchidos)
    if (!empty($_POST["nome"]) && !empty($_POST["categoria"]) && !empty($_POST["fabricante"])) {
        // Criação do produto como array associativo
        $produto = [
            "nome" => $_POST["nome"],
            "categoria" => $_POST["categoria"],
            "fabricante" => $_POST["fabricante"]
        ];

        // Adiciona o produto ao array da sessão (sem sobrescrever os existentes)
        $_SESSION["produtos"][] = $produto;

        // Fica na mesma página após cadastro (sem redirecionar)
        echo "<p style='color: green;'>Produto cadastrado com sucesso!</p>";
    } else {
        echo "<p style='color: red;'>Preencha todos os campos!</p>";
    }
}
?>

<!-- Formulário HTML -->
<h2>Cadastro de Produto</h2>
<form method="post">
    <label>Nome do Produto:</label><br>
    <input type="text" name="nome"><br><br>

    <label>Categoria:</label><br>
    <select name="categoria">
        <option value="Limpeza">Limpeza</option>
        <option value="Cereais">Cereais</option>
        <option value="Armarinho">Armarinho</option>
    </select><br><br>

    <label>Fabricante:</label><br>
    <input type="text" name="fabricante"><br><br>

    <input type="submit" value="Cadastrar">
</form>

<br>
<br>
<a href="listas.php">Ver Tabela Completa</a>

</body>
</html>

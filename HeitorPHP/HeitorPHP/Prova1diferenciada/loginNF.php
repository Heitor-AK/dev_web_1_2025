<?php
session_start();
$usuarios = [
    ["email" => "admin@admin.com", "nome" => "Admin", "senha" => "123"],
    ["email" => "user@user.com", "nome" => "User", "senha" => "123"],
    ["email" => "guest@guest.com", "nome" => "Guest", "senha" => "123"]
];

$erro = "";

    $email = $_POST["email"];
    $senha = $_POST["senha"];

    foreach ($usuarios as $usuario) {
        if ($usuario["email"] === $email && $usuario["senha"] === $senha) {
            $_SESSION["email"] = $usuario["email"];
            $_SESSION["nome"] = $usuario["nome"];
            header("Location: cadastro.php");
        exit;
    }
}

$erro = "E-mail ou senha inválidos.";
?>

<form method="post">
    <h2>Login</h2>
    <label>E-mail:</label><br>
    <input type="email" name="email" required><br><br>
    <label>Senha:</label><br>
    <input type="password" name="senha" required><br><br>
    <button type="submit">Entrar</button><br><br>
    <p style="color:red;"><?= $erro ?></p>
</form>
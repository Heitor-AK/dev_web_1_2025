<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Login - Sistema Hospitalar</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

	<?php
session_start();
$usuarios = [
    ["email" => "jorje@user.com", "nome" => "Jorje", "senha" => "123", "perfil" => "Médico"],
    ["email" => "matusalem@user.com", "nome" => "Matutalém", "senha" => "456", "perfil" => "Enfermeiro"],
    ["email" => "frederico@user.com", "nome" => "Frederico", "senha" => "789", "perfil" => "Recepcionista"]
];

$erro = "E-mail, senha ou perfil inválidos.";

if (isset ($_POST["email"])) {
    $email = $_POST["email"];
    $senha = $_POST["senha"];
	$perfil = $_POST["perfil"];
}
else {
	$email = 0;
}
	
	if (!isset($_SESSION["usuarios"][$email])) {
		$_SESSION["email"] = [];
	}	

    foreach ($usuarios as $usuario) {
	if ($usuario["email"] === $email && $usuario["senha"] === $senha && $usuario["perfil"] === $perfil) {
            $_SESSION["email"] = $usuario["email"];
            $_SESSION["nome"] = $usuario["nome"];
			$_SESSION["perfil"] = $usuario["perfil"];
            header("Location: cadastro.php");
        exit;
    }
}
	?>
  <div class="container">
    <h2>Login de Usuário</h2>
    <form method="post">
      <label for="email">E-mail:</label>
      <input type="email" name="email" required>

      <label for="senha">Senha:</label>
      <input type="password" name="senha" required>

      <label for="perfil">Perfil:</label>
      <select name="perfil" required>
        <option value="">Selecione o perfil</option>
        <option value="Recepcionista">Recepcionista</option>
        <option value="Médico">Médico</option>
        <option value="Enfermeiro">Enfermeiro</option>
      </select>
      <button type="submit">Entrar</button>
	  <p style="color:red;"><?= $erro ?></p> 
    </form>
  </div>
</body>
</html>

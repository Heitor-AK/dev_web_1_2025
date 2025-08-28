<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Cadastro de Paciente</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
 session_start(); 

if (!isset($_SESSION["email"])) {
    header("Location: login.php");
    exit;
	
}

if (isset ($_POST["nome"]) ){
$_SESSION ["paciente"] = [
        "nome" => $_POST["nome"],
        "genero" => $_POST["genero"],
        "idade" => $_POST["idade"],
        "sangue" => $_POST["sangue"],
        "doenca" => $_POST["doenca"],
        "gravidade" => $_POST["gravidade"],
    ];
	}
	
	$email = $_SESSION["email"];
	
	    if (!isset($_SESSION["paciente"][$email])) {
        $_SESSION["paciente"][$email] = [];
		}

?>
  <div class="container">
    <h2>Cadastro de Paciente</h2>
    <p><strong>Usuário logado:</strong> <?= $_SESSION["email"] ?></p>

    <form method="POST" action="cadastro.php">
      <label for="nome">Nome do Paciente:</label>
      <input type="text" name="nome" required>

      <label for="genero">Gênero:</label>
      <select name="genero" required>
        <option>Masculino</option>
        <option>Feminino</option>
        <option>Outro</option>
      </select>

      <label for="idade">Idade:</label>
      <input type="number" name="idade" required>

      <label for="sangue">Tipo Sanguíneo:</label>
      <select name="sangue" required>
        <option>A+</option>
        <option>A−</option>
        <option>B+</option>
        <option>B−</option>
        <option>AB+</option>
        <option>AB−</option>
        <option>O+</option>
        <option>O−</option>
      </select>

      <label for="doenca">Doença Diagnosticada:</label>
      <input type="text" name="doenca" required>

      <label for="gravidade">Gravidade:</label>
      <select name="gravidade" required>
        <option>Leve</option>
        <option>Moderado</option>
        <option>Grave</option>
        <option>Crítico</option>
      </select>

      <label for="data">Data de Admissão:</label>
      <input type="date" name="data" required>

      <button type="submit">Cadastrar Paciente</button>
    </form>

    <p><a href="lista.php">🔙 Ir para Lista de Pacientes</a></p>
  </div>
</body>
</html>

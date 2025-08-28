<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Lista de Pacientes</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
session_start(); 

if (!isset($_SESSION["email"])) {
    header("Location: login.php");
    exit;
	
}
?>
  <div class="container">
    <h2>Pacientes Cadastrados</h2>
    <p><strong>Usuário logado:</strong> <?= $_SESSION["email"] ?> (Perfil: <?= $_SESSION["perfil"] ?>)</p>

    <table>
      <thead>
        <tr>
          <th>Nome</th>
          <th>Idade</th>
          <th>Doença</th>
          <th>Gravidade</th>
          <th>Risco</th>
        </tr>
      </thead>
      <tbody>
        <tr>
            <td><?= @htmlspecialchars($_SESSION["paciente"]["nome"]) ?></td>
            <td><?= @htmlspecialchars($_SESSION["paciente"]["idade"]) ?></td>
            <td><?= @htmlspecialchars($_SESSION["paciente"]["doenca"]) ?></td>
            <td><?= @htmlspecialchars($_SESSION["paciente"]["gravidade"]) ?></td>
            <td><?php if (@$_SESSION["paciente"]["gravidade"] == "Leve" ){
						echo "Baixo"; }
						if (@$_SESSION["paciente"]["gravidade"] == "Moderado") {
						echo "Médio"; }
						if (@$_SESSION["paciente"]["gravidade"] == "Grave") {
						echo "Alto"; }
						if (@$_SESSION["paciente"]["gravidade"] == "Crítico") {
							if (@$_SESSION["paciente"]["idade"] < 60) {
							echo "Muito Alto";}
							if (@$_SESSION["paciente"]["idade"] >= 60) {
							echo "Extremo";} 
						} ?></td>
        </tr>
      </tbody>
    </table>

    <p><a href="cadastro.php">➕ Cadastrar Novo Paciente</a></p>
  </div>
</body>
</html>
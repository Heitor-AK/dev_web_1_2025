<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Login - Locadora</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
    }

    header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #f1f3f4;
      padding: 10px 20px;
      border-bottom: 1px solid #ccc;
    }

    main {
      padding: 20px;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 80vh;
    }

    form {
      display: flex;
      flex-direction: column;
      gap: 15px;
      width: 300px;
    }

    form input {
      padding: 10px;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    form button {
      padding: 10px;
      background-color: #4285f4;
      color: white;
      font-size: 16px;
      border: none;
      cursor: pointer;
      border-radius: 5px;
    }

    form button:hover {
      background-color: #357ae8;
    }
  </style>
</head>
<body>
<?php
if (!isset($_SESSION["usuarios"])) {
    $_SESSION["usuarios"] = [];
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["email"]) && !empty($_POST["senha"])  && !empty($_POST["nome"])) {
$usuarios = [
    [
        'nome' => 'usuario1',
        'email' => 'usuario1@gmail.com',
        'senha' => 'a8XkP2zq'
    ],
    [
        'nome' => 'usuario2',
        'email' => 'usuario2@yahoo.com',
        'senha' => 'Lm9vT7sE'
    ],
    [
        'nome' => 'usuario3',
        'email' => 'usuario3@hotmail.com',
        'senha' => 'Pq4rZ1wL'
    ]
];

        $_SESSION["usuarios"][] = $usuarios;
	}
}
?>
  <header>
    <h2>Locadora</h2>
  </header>

  <main>
    <form action="cadastro.php" method="POST">
      <h2>Login</h2>
      <input type="email" placeholder="E-mail" required>
      <input type="password" placeholder="Senha" required>
      <button type="submit">Entrar</button>
    </form>
  </main>
</body>
</html>

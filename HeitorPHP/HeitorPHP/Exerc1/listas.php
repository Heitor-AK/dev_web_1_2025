<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
session_start(); // Sempre iniciar a sessão para acessar $_SESSION
?>

<h2>Lista de Produtos</h2>

<?php if (!empty($_SESSION["produtos"])): ?>
    <table border="1" cellpadding="5">
        <tr>
            <th>Nome</th>
            <th>Categoria</th>
            <th>Fabricante</th>
        </tr>
        <?php foreach ($_SESSION["produtos"] as $produto): ?>
            <tr>
                <td><?= htmlspecialchars($produto["nome"]) ?></td>
                <td><?= htmlspecialchars($produto["categoria"]) ?></td>
                <td><?= htmlspecialchars($produto["fabricante"]) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p>Nenhum produto cadastrado.</p>
<?php endif; ?>

</body>
</html>
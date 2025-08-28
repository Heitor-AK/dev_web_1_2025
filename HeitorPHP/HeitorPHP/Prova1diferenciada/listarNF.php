<?php
session_start();

if (!isset($_SESSION["email"])) {
    header("Location: login.php");
    exit;
}

$email = $_SESSION["email"];
$veiculos = $_SESSION["veiculos"][$email] ?? [];

function calcularImposto($preco, $combustivel) {
    if ($preco <= 100000) {
        return match($combustivel) {
            "Diesel" => 0.20,
            "Elétrico" => 0.25,
            default => 0.30
        };
    } elseif ($preco <= 200000) {
        return match($combustivel) {
            "Diesel" => 0.25,
            "Elétrico" => 0.30,
            default => 0.35
        };
    } else {
        return 0.40;
    }
}
?>

<h2>Veículos Cadastrados</h2>
<p>Usuário logado: <?= $email ?></p>

<?php if (count($veiculos) > 0): ?>
    <table border="1" cellpadding="5">
        <tr>
            <th>Modelo</th>
            <th>Montadora</th>
            <th>Tipo de Combustível</th>
            <th>Preço (R$)</th>
            <th>Imposto (R$)</th>
        </tr>
        <?php foreach ($veiculos as $v): 
            $imposto = $v["preco"] * calcularImposto($v["preco"], $v["combustivel"]);
        ?>
        <tr>
            <td><?= htmlspecialchars($v["modelo"]) ?></td>
            <td><?= htmlspecialchars($v["montadora"]) ?></td>
            <td><?= $v["combustivel"] ?></td>
            <td><?= number_format($v["preco"], 2, ',', '.') ?></td>
            <td><?= number_format($imposto, 2, ',', '.') ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p>Nenhum veículo cadastrado.</p>
<?php endif; ?>

<br>
<a href="cadastro.php">Ir para cadastro de veículos</a>
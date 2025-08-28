<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style> 
        body {
    font-family: sans-serif;
    text-align: center;
    background: #f0f0f0;
}

table {
    border-collapse: collapse;
    margin: 20px auto;
}

td {
    width: 60px;
    height: 60px;
    padding: 0;
}

td.white {
    background-color: #f0d9b5;
}

td.black {
    background-color: #b58863;
}

button {
    width: 100%;
    height: 100%;
    border: none;
    background: transparent;
    font-size: 30px;
    cursor: pointer;
}

button:focus {
    outline: 2px solid red;
}

    </style>
</head>
<body>
<?php
session_start();

// Inicializa o tabuleiro
if (!isset($_SESSION['board'])) {
    $_SESSION['board'] = initializeBoard();
    $_SESSION['turn'] = 'B'; // Branco começa
    $_SESSION['selected'] = null;
    $_SESSION['captureAvailable'] = false; // Flag para captura múltipla
}

$board = &$_SESSION['board'];
$turn = &$_SESSION['turn'];
$selected = &$_SESSION['selected'];
$captureAvailable = &$_SESSION['captureAvailable'];

function initializeBoard() {
    $board = [];
    for ($i = 0; $i < 8; $i++) {
        for ($j = 0; $j < 8; $j++) {
            if (($i + $j) % 2 == 1) {
                if ($i < 3) {
                    $board[$i][$j] = 'P';
                } elseif ($i > 4) {
                    $board[$i][$j] = 'B';
                } else {
                    $board[$i][$j] = '';
                }
            } else {
                $board[$i][$j] = '';
            }
        }
    }
    return $board;
}

// Converte coordenadas do botão (ex: A3) para [linha, coluna]
function coord($pos) {
    $col = ord(strtoupper($pos[0])) - 65;
    $row = 8 - (int)$pos[1];
    return [$row, $col];
}

function isValidMove($from, $to, $board, $turn) {
    [$fx, $fy] = coord($from);
    [$tx, $ty] = coord($to);

    $dx = $tx - $fx;
    $dy = $ty - $fy;

    $piece = $board[$fx][$fy];
    $target = $board[$tx][$ty];

    if ($target != '') return false; // Se a casa de destino estiver ocupada
    if (strtoupper($piece) != $turn) return false; // Se não for a vez do jogador

    $isKing = ($piece === 'B*' || $piece === 'P*');
    $forward = ($turn == 'B') ? -1 : 1;

    // Movimento simples
    if (abs($dx) == 1 && abs($dy) == 1) {
        if ($isKing || $dx == $forward) return true;
    }

    // Captura
    if (abs($dx) == 2 && abs($dy) == 2) {
        $mx = $fx + $dx / 2;
        $my = $fy + $dy / 2;
        $middle = $board[$mx][$my];
        if ($middle != '' && strtoupper($middle) != $turn) {
            return true;
        }
    }

    return false;
}

function performMove($from, $to) {
    global $board;
    [$fx, $fy] = coord($from);
    [$tx, $ty] = coord($to);

    $dx = $tx - $fx;
    $dy = $ty - $fy;

    $piece = $board[$fx][$fy];
    $board[$fx][$fy] = '';
    $board[$tx][$ty] = $piece;

    // Captura
    if (abs($dx) == 2 && abs($dy) == 2) {
        $mx = $fx + $dx / 2;
        $my = $fy + $dy / 2;
        $board[$mx][$my] = ''; // Remove a peça capturada
    }

    // Promoção
    if ($turn == 'B' && $tx == 0 && $piece == 'B') {
        $board[$tx][$ty] = 'B*';
    } elseif ($turn == 'P' && $tx == 7 && $piece == 'P') {
        $board[$tx][$ty] = 'P*';
    }
}

// Verifica se existem movimentos de captura possíveis
function hasCaptureMoves($board, $turn) {
    for ($i = 0; $i < 8; $i++) {
        for ($j = 0; $j < 8; $j++) {
            $piece = $board[$i][$j];
            if ($piece && strtoupper($piece) == $turn) {
                // Verifica se há capturas possíveis a partir desta peça
                $directions = [
                    [-2, -2], [-2, 2], [2, -2], [2, 2]
                ];

                foreach ($directions as $dir) {
                    $newX = $i + $dir[0];
                    $newY = $j + $dir[1];
                    if ($newX >= 0 && $newX < 8 && $newY >= 0 && $newY < 8) {
                        $middleX = $i + $dir[0] / 2;
                        $middleY = $j + $dir[1] / 2;
                        if ($board[$newX][$newY] == '' && $board[$middleX][$middleY] != '' && strtoupper($board[$middleX][$middleY]) != $turn) {
                            return true; // Encontrou uma captura possível
                        }
                    }
                }
            }
        }
    }
    return false;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['pos'])) {
        $pos = $_POST['pos'];

        if ($selected === null) {
            [$x, $y] = coord($pos);
            if ($board[$x][$y] != '' && strtoupper($board[$x][$y]) == $_SESSION['turn']) {
                $selected = $pos;
            }
        } else {
            if (isValidMove($selected, $pos, $board, $_SESSION['turn'])) {
                performMove($selected, $pos);

                // Verifica se a captura múltipla é possível após o movimento
                $captureAvailable = hasCaptureMoves($board, $_SESSION['turn']);

                // Se não houver captura múltipla, alterna o turno
                if (!$captureAvailable) {
                    // Alterna entre 'B' (Branco) e 'P' (Preto)
                    $_SESSION['turn'] = $_SESSION['turn'] == 'B' ? 'P' : 'B';
                }
            }

            // Limpa a seleção após o movimento
            $_SESSION['selected'] = null;
        }
    }

    if (isset($_POST['reset'])) {
        session_destroy();
        header("Location: index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Jogo de Damas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h2>Jogo de Damas - Vez do jogador: <?= $_SESSION['turn'] == 'B' ? 'Branco' : 'Preto' ?></h2>
<h3>Captura múltipla <?= $captureAvailable ? 'disponível' : 'não disponível' ?></h3>
<form method="post">
    <table>
        <?php for ($i = 0; $i < 8; $i++): ?>
            <tr>
                <?php for ($j = 0; $j < 8; $j++):
                    $bg = ($i + $j) % 2 == 0 ? 'white' : 'black';
                    $cell = chr(65 + $j) . (8 - $i);
                    $piece = $board[$i][$j];
                    $symbol = match ($piece) {
                        'B' => '⚪',
                        'P' => '⚫',
                        'B*' => '♔',
                        'P*' => '♚',
                        default => ''
                    };
                    ?>
                    <td class="<?= $bg ?>">
                        <button type="submit" name="pos" value="<?= $cell ?>">
                            <?= $symbol ?>
                        </button>
                    </td>
                <?php endfor; ?>
            </tr>
        <?php endfor; ?>
    </table>
    <button type="submit" name="reset" value="1">Reiniciar Jogo</button>
</form>
</body>
</html>

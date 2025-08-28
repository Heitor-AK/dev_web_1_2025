<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php
     $a=isset($_GET["A"])?$_GET["A"]:"";
     $b=isset($_GET["B"])?$_GET["B"]:"";
     $op=isset($_GET["seletor"])?$_GET["seletor"]:"";
     ?>
<body>
    <form method="get">

    <input type="text" name="A" value="<?=$a?>"/>
    <br>
    <br>
    <input type="text" name="B" value="<?=$b?>"/>
    <br>
    <br>
    <select name="seletor">
        <option value="soma">Soma</option>
        <option value="subtração">Subtração</option>
        <option value="multiplicação">Multiplicação</option>
        <option value="divisão">Divisão</option>
    </select>
    <br>
    <br>
    <button type="submit" name="botao">Enviar</button>

    </form>

  <?php  

     if ($a==""||$b=="") {
         die ("dados invalidos");
     }
     if ($op=="soma") {
         echo "O resultado é: ".$a+$b;
     }
     if ($op=="subtração") {
         echo "O resultado é: ".$a-$b;
     }
     if ($op=="multiplicação") {
         echo "O resultado é: ".$a*$b;
     }
     if ($op=="divisão") {
         echo "O resultado é: ".$a/$b;
     }
    ?>
</body>
</html>
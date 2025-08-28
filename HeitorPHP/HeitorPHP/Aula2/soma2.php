<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    //var_dump($_GET);
    $a=$_GET["A"];
    $b=$_GET["B"];
    $op=$_GET["op"];
    //echo "Resultado: ";
    //echo $a+$b;
    function calculos($a,$b,$op){
    if ($a==""||$b=="") {
        die ("dados invalidos");
    }
    if ($op=="soma") {
        $result=$a+$b;
    }
    if ($op=="subtração") {
        $result=$a-$b;
    }
    if ($op=="multiplicação") {
        $result=$a*$b;
    }
    if ($op=="divisão") {
        $result=$a/$b;
    }

    return $result;
}

    echo "O resultado é: ". calculos($a, $b, $op);
    ?>
</body>
</html>
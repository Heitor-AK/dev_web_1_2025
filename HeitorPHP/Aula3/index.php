<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php

/*
$a=2;
$b="2";
$a==$b; compara somente o valor e nesse caso daria verdadeiro
$a===$b; compara o valor e o tipo e nesse caso daria falso
*/
//para fazer exponencial são duas multiplicações seguidas: **
/*
$a=1;
if (empty ($a)) {
    echo "oi";
}
else {
    echo "oi2";
}8
*/

$a=1;
$b=3;
echo $b + ++$a;//++ antes da variavel somar 1 a ela na hora
echo $a;
echo $a++;//++ depois da variavel vai somar 1 a ela mas não vai mostrar na mesma linha
echo $a;

$nome="H";
$nome.="eitor";//essa linha tem o mesmo resultado
//=
//$nome=$nome."eitor"; dessa linha
echo $nome;

?>
</body>
</html> 
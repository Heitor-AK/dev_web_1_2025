<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    
    if (!isset($_GET["nome"])){

?>
<form method="get">
  <div>
    <label for="nome">Nome:</label>
    <input type="text" name="nome" />
  </div>
  <br>  
  <div>
    <label for="sobrenome">Sobrenome:</label>
    <input type="text" name="sobrenome" />
  </div>
  <br>
  <button type="submit">Enviar</button>
</form>

<?php
}
else{
    $nome=$_GET["nome"];
    $sobrenome=$_GET["sobrenome"];
    echo $nome.=" ".$sobrenome;     
}
?>
</body>
</html>
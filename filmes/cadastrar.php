<?php

include("../login/conexao.php");
include("../login/protect.php");

if(isset($_POST['titulo'])){

    $sql = $conn->prepare("
        INSERT INTO filmes
        (titulo,genero,duracao,classificacao)
        VALUES(?,?,?,?)
    ");

    $sql->execute([
        $_POST['titulo'],
        $_POST['genero'],
        $_POST['duracao'],
        $_POST['classificacao']
    ]);

    header("Location: listar.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>

<meta charset="UTF-8">

<title>Cadastrar Filme</title>

<link rel="stylesheet" href="filmes.css">

</head>

<body>
    

<div class="container">

<h1> ✚Cadastrar Filme</h1>

<form class="form-card" method="POST">

<label>Título</label>
<input type="text" name="titulo" required>

<label>Gênero</label>
<input type="text" name="genero" required>

<label>Duração (min)</label>
<input type="number" name="duracao" required>

<label>Classificação</label>
<input type="text" name="classificacao" required>

<button class="btn-verde" type="submit">
Salvar Filme
</button>

</form>

</div>

</body>
</html>
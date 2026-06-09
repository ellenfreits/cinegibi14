<?php

include("../login/conexao.php");
include("../login/protect.php");

$id = $_GET['id'];

if(isset($_POST['titulo'])){

    $sql = $conn->prepare("
        UPDATE filmes
        SET titulo=?,
            genero=?,
            duracao=?,
            classificacao=?
        WHERE id=?
    ");

    $sql->execute([
        $_POST['titulo'],
        $_POST['genero'],
        $_POST['duracao'],
        $_POST['classificacao'],
        $id
    ]);

    header("Location: listar.php");
    exit();
}

$sql = $conn->prepare(
    "SELECT * FROM filmes WHERE id=?"
);

$sql->execute([$id]);

$filme = $sql->fetch();

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>

<meta charset="UTF-8">

<title>Editar Filme</title>

<link rel="stylesheet" href="filmes.css">

</head>

<body>
<?php include("../navbar.php"); ?>
<div class="container">

<h1>Editar Filme</h1>

<form class="form-card" method="POST">

<label>Título</label>
<input
type="text"
name="titulo"
value="<?= $filme['titulo'] ?>"
required>

<label>Gênero</label>
<input
type="text"
name="genero"
value="<?= $filme['genero'] ?>"
required>

<label>Duração</label>
<input
type="number"
name="duracao"
value="<?= $filme['duracao'] ?>"
required>

<label>Classificação</label>
<input
type="text"
name="classificacao"
value="<?= $filme['classificacao'] ?>"
required>

<button class="btn-azul" type="submit">
Atualizar Filme
</button>

</form>

</div>

</body>
</html>
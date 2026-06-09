<?php

include("../login/conexao.php");
include("../login/protect.php");

$filmes = $conn->query(
    "SELECT * FROM filmes"
)->fetchAll();

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Filmes - CineGibi</title>

    <link rel="stylesheet" href="filmes.css">
    <link rel="stylesheet" href="../navbar.css">


</head>

<body>
<?php include("../navbar.php"); ?>
    <h1>Filmes</h1>

    <a href="cadastrar.php" class="btn-cadastrar">
        +   Cadastrar Filme
    </a>

<table>

<tr>
    <th>ID</th>
    <th>Título</th>
    <th>Gênero</th>
    <th>Duração</th>
    <th>Classificação</th>
    <th>Ações</th>
</tr>

<?php foreach($filmes as $filme): ?>

<tr>

<td><?= $filme['id'] ?></td>

<td><?= $filme['titulo'] ?></td>

<td><?= $filme['genero'] ?></td>

<td><?= $filme['duracao'] ?> min</td>

<td><?= $filme['classificacao'] ?></td>

<td>

<a
class="btn-editar"
href="editar.php?id=<?= $filme['id'] ?>">
✏️ Editar
</a>

<a
class="btn-excluir"
href="deletar.php?id=<?= $filme['id'] ?>"
onclick="return confirm('Excluir filme?')">
🗑️ Excluir
</a>

</td>

</tr>

<?php endforeach; ?>

</table>

</body>

</html>
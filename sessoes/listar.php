<?php

include("../login/conexao.php");
include("../login/protect.php");

$sessoes = $conn->query("
SELECT

sessoes.*,
filmes.titulo

FROM sessoes

INNER JOIN filmes
ON filmes.id = sessoes.filme_id

ORDER BY data_sessao
")->fetchAll();

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

<meta charset="UTF-8">

<title>Sessões</title>

<link rel="stylesheet" href="sessoes.css">

</head>

<body>

<h1>🎥 Sessões</h1>

<a href="cadastrar.php" class="btn-cadastrar">
➕ Nova Sessão
</a>

<table>

<tr>
<th>ID</th>
<th>Filme</th>
<th>Data</th>
<th>Horário</th>
<th>Sala</th>
<th>Ações</th>
</tr>

<?php foreach($sessoes as $sessao): ?>

<tr>

<td><?= $sessao['id'] ?></td>

<td><?= $sessao['titulo'] ?></td>

<td><?= $sessao['data_sessao'] ?></td>

<td><?= substr($sessao['horario'],0,5) ?></td>

<td><?= $sessao['sala'] ?></td>

<td>

<a
class="btn-editar"
href="editar.php?id=<?= $sessao['id'] ?>">
✏️ Editar
</a>

<a
class="btn-excluir"
href="deletar.php?id=<?= $sessao['id'] ?>"
onclick="return confirm('Excluir sessão?')">
🗑️ Excluir
</a>

</td>

</tr>

<?php endforeach; ?>

</table>

</body>
</html>
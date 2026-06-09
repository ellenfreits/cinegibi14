<?php

include("../login/conexao.php");
include("../login/protect.php");

$ingressos = $conn->query("
SELECT
ingressos.id,
ingressos.cliente,
ingressos.quantidade,
ingressos.valor,
ingressos.forma_pagamento,
filmes.titulo

FROM ingressos

INNER JOIN filmes
ON ingressos.filme_id = filmes.id

ORDER BY ingressos.id DESC
")->fetchAll();

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

<meta charset="UTF-8">

<title>Ingressos</title>

<link rel="stylesheet" href="ingresso.css">

</head>

<body>

<h1>🎟️ Ingressos</h1>

<a class="btn-cadastrar" href="cadastrar.php">
➕ Novo Ingresso
</a>

<table>

<tr>

<th>ID</th>
<th>Cliente</th>
<th>Filme</th>
<th>Quantidade</th>
<th>Valor</th>
<th>Forma de Pagamento</th>
<th>Ações</th>

</tr>

<?php foreach($ingressos as $ingresso): ?>

<tr>

    <td><?= $ingresso['id'] ?></td>

    <td><?= $ingresso['cliente'] ?></td>

    <td><?= $ingresso['titulo'] ?></td>

    <td><?= $ingresso['quantidade'] ?></td>

    <td>R$ <?= number_format($ingresso['valor'], 2, ',', '.') ?></td>

    <td><?= $ingresso['forma_pagamento'] ?></td>

    <td>

        <a class="btn-editar"
        href="editar.php?id=<?= $ingresso['id'] ?>">
            ✏️ Editar
        </a>

        <a class="btn-excluir"
        href="deletar.php?id=<?= $ingresso['id'] ?>">
            🗑️ Excluir
        </a>

    </td>

</tr>
<?php endforeach; ?>

</table>

</body>
</html>
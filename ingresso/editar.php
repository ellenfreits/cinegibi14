<?php

include("../login/conexao.php");
include("../login/protect.php");

$id = $_GET['id'];

if(isset($_POST['cliente'])){

    $sql = $conn->prepare("
        UPDATE ingressos
        SET
        cliente=?,
        filme_id=?,
        quantidade=?,
        valor=?,
        forma_pagamento=?
        WHERE id=?
    ");

    $sql->execute([
        $_POST['cliente'],
        $_POST['filme_id'],
        $_POST['quantidade'],
        $_POST['valor'],
        $_POST['forma_pagamento'],
        $id
    ]);

    header("Location: listar.php");
    exit();
}

$sql = $conn->prepare(
    "SELECT * FROM ingressos WHERE id=?"
);

$sql->execute([$id]);

$ingresso = $sql->fetch();

$filmes = $conn->query(
    "SELECT * FROM filmes ORDER BY titulo"
)->fetchAll();

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

<meta charset="UTF-8">

<title>Editar Ingresso</title>

<link rel="stylesheet" href="ingresso.css">

</head>

<body>
<?php include("../navbar.php"); ?>
<div class="container">

<h1> Editar Ingresso</h1>

<form class="form-card" method="POST">

<label>Cliente</label>

<input
type="text"
name="cliente"
value="<?= $ingresso['cliente'] ?>"
required>

<label>Filme</label>

<select name="filme_id">

<?php foreach($filmes as $filme): ?>

<option
value="<?= $filme['id'] ?>"
<?= $filme['id'] == $ingresso['filme_id'] ? 'selected' : '' ?>
>

<?= $filme['titulo'] ?>

</option>

<?php endforeach; ?>

</select>

<label>Quantidade</label>

<input
type="number"
name="quantidade"
value="<?= $ingresso['quantidade'] ?>"
required>

<label>Valor</label>

<input
type="number"
step="0.01"
name="valor"
value="<?= $ingresso['valor'] ?>"
required>

<label>Forma de Pagamento</label>

<select name="forma_pagamento" required>

    <option value="Dinheiro"
        <?= $ingresso['forma_pagamento'] == 'Dinheiro' ? 'selected' : '' ?>>
        💵 Dinheiro
    </option>

    <option value="Pix"
        <?= $ingresso['forma_pagamento'] == 'Pix' ? 'selected' : '' ?>>
        📱 Pix
    </option>

    <option value="Cartão de Débito"
        <?= $ingresso['forma_pagamento'] == 'Cartão de Débito' ? 'selected' : '' ?>>
        💳 Cartão de Débito
    </option>

    <option value="Cartão de Crédito"
        <?= $ingresso['forma_pagamento'] == 'Cartão de Crédito' ? 'selected' : '' ?>>
        💳 Cartão de Crédito
    </option>

</select>

<button class="btn-azul" type="submit">
Atualizar Ingresso
</button>

</form>

</div>

</body>
</html>
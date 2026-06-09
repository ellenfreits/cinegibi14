<?php

include("../login/conexao.php");
include("../login/protect.php");

$filmes = $conn->query(
    "SELECT * FROM filmes ORDER BY titulo"
)->fetchAll();

if(isset($_POST['cliente'])){

    $valor = $_POST['quantidade'] * 15;

    $sql = $conn->prepare("
        INSERT INTO ingressos
        (
            cliente,
            filme_id,
            quantidade,
            valor,
            forma_pagamento
        )
        VALUES (?, ?, ?, ?, ?)
    ");

    $sql->execute([
        $_POST['cliente'],
        $_POST['filme_id'],
        $_POST['quantidade'],
        $valor,
        $_POST['forma_pagamento']
    ]);

    header("Location: listar.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Ingresso</title>
    <link rel="stylesheet" href="ingresso.css">
</head>
<body>
<?php include("../navbar.php"); ?>
<div class="container">

<h1>🎟️ Cadastrar Ingresso</h1>

<form class="form-card" method="POST">

<label>Cliente</label>
<input type="text" name="cliente" required>

<?php

$sessoes = $conn->query("
SELECT
sessoes.id,
sessoes.data_sessao,
sessoes.horario,
filmes.titulo

FROM sessoes

INNER JOIN filmes
ON filmes.id = sessoes.filme_id

ORDER BY filmes.titulo
")->fetchAll();

?>

<?php foreach($filmes as $filme): ?>

<option value="<?= $filme['id'] ?>">
<?= $filme['titulo'] ?>
</option>

<?php endforeach; ?>

</select>

<label>Quantidade</label>
<input type="number" name="quantidade" required>

<label>Valor Total</label>

<input
type="number"
step="0.01"
name="valor"
id="valor"
readonly>

<label>Forma de Pagamento</label>

<select name="forma_pagamento" required>

    <option value="">Selecione</option>

    <option value="Dinheiro">
        💵 Dinheiro
    </option>

    <option value="Pix">
        📱 Pix
    </option>

    <option value="Cartão de Débito">
        💳 Cartão de Débito
    </option>

    <option value="Cartão de Crédito">
        💳 Cartão de Crédito
    </option>

</select>


<button class="btn-verde" type="submit">
Salvar Ingresso
</button>

</form>

</div>
<script>

const quantidade = document.querySelector(
'input[name="quantidade"]'
);

const valor = document.getElementById('valor');

quantidade.addEventListener('input', () => {

    let total = quantidade.value * 15;

    valor.value = total.toFixed(2);

});

</script>
</body>
</html>
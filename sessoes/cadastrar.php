<?php

include("../login/conexao.php");
include("../login/protect.php");

$filmes = $conn->query("
    SELECT *
    FROM filmes
    ORDER BY titulo
")->fetchAll();

if(isset($_POST['filme_id'])){

    $sql = $conn->prepare("
        INSERT INTO sessoes
        (
            filme_id,
            data_sessao,
            horario,
            sala
        )
        VALUES (?, ?, ?, ?)
    ");

    $sql->execute([
        $_POST['filme_id'],
        $_POST['data_sessao'],
        $_POST['horario'],
        $_POST['sala']
    ]);

    header("Location: listar.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

<meta charset="UTF-8">

<title>Cadastrar Sessão</title>

<link rel="stylesheet" href="sessoes.css">

</head>

<body>

<div class="container">

<h1>✚ Cadastrar Sessão</h1>

<form class="form-card" method="POST">

<label>Filme</label>

<select name="filme_id" required>

<?php foreach($filmes as $filme): ?>

<option value="<?= $filme['id'] ?>">
<?= $filme['titulo'] ?>
</option>

<?php endforeach; ?>

</select>

<label>Data</label>
<input type="date" name="data_sessao" required>

<label>Horário</label>
<input type="time" name="horario" required>

<label>Sala</label>
<input type="text" name="sala" required>

<button type="submit">
💾 Salvar Sessão
</button>

</form>

</div>

</body>
</html>
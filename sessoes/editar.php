<?php

include("../login/conexao.php");
include("../login/protect.php");

$id = $_GET['id'];

$filmes = $conn->query("
    SELECT *
    FROM filmes
    ORDER BY titulo
")->fetchAll();

if(isset($_POST['filme_id'])){

    $sql = $conn->prepare("
        UPDATE sessoes
        SET
        filme_id=?,
        data_sessao=?,
        horario=?,
        sala=?
        WHERE id=?
    ");

    $sql->execute([
        $_POST['filme_id'],
        $_POST['data_sessao'],
        $_POST['horario'],
        $_POST['sala'],
        $id
    ]);

    header("Location: listar.php");
    exit();
}

$sql = $conn->prepare("
    SELECT *
    FROM sessoes
    WHERE id=?
");

$sql->execute([$id]);

$sessao = $sql->fetch();

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

<meta charset="UTF-8">

<title>Editar Sessão</title>

<link rel="stylesheet" href="sessoes.css">

</head>

<body>

<div class="container">

<h1> Editar Sessão</h1>

<form class="form-card" method="POST">

<label>Filme</label>

<select name="filme_id">

<?php foreach($filmes as $filme): ?>

<option
value="<?= $filme['id'] ?>"
<?= $filme['id'] == $sessao['filme_id'] ? 'selected' : '' ?>
>

<?= $filme['titulo'] ?>

</option>

<?php endforeach; ?>

</select>

<label>Data</label>

<input
type="date"
name="data_sessao"
value="<?= $sessao['data_sessao'] ?>"
required>

<label>Horário</label>

<input
type="time"
name="horario"
value="<?= substr($sessao['horario'],0,5) ?>"
required>

<label>Sala</label>

<input
type="text"
name="sala"
value="<?= $sessao['sala'] ?>"
required>

<button type="submit">
Atualizar Sessão
</button>

</form>

</div>

</body>
</html>
<?php

include("../login/conexao.php");
include("../login/protect.php");

$id = $_GET['id'];

$sql = $conn->prepare(
    "DELETE FROM filmes WHERE id=?"
);

$sql->execute([$id]);

header("Location: listar.php");
exit();
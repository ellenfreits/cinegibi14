<?php

session_start();

if (!isset($_SESSION['id'])) {

    header("Location: ../login/index.php");
    exit();

}

$id = $_SESSION['id'];
$nome = $_SESSION['nome'];
$email = $_SESSION['email'];

?>s
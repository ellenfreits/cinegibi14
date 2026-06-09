<?php
$conn = new PDO("mysql:host=db;dbname=cinegibi", "root", "root");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
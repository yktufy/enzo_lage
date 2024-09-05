<?php
$host = "localhost";
$db_user = "root";
$db_password = "senai";
$db_name = "pingpong";

$conn = new mysqli($host, $db_user, $db_password, $db_name);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>

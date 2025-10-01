<?php
$usuario = 'root';
$senha = '';
$database = 'usuario';
$host = 'localhost';

$mysqli = new mysqli(hostname: $host, username: $usuario, password: $senha, database: $database);

if($mysqli->error){
    die("Falha ao conecat ao banco de dados: " . $mysqli->error);
}
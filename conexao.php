<?php


$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'gestao_estoque';

$conn = new mysqli($host, $user, $pass, $dbname);

if($conn->connect_error){

    die('Erro ao conectar ao banco de dados:'. $conn->connect_error);

}

?>
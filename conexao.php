<?php


$host = 'localhost'; // declarando o tipo de host que o db esta hospedado
$user = 'root'; // usuario para acesso a banco
$pass = ''; // senha do banco de dados
$dbname = 'gestao_estoque'; //nome do banco que sera acessado

$conn = new mysqli($host, $user, $pass, $dbname); // estabelendo conexão com banco de dados 

if($conn->connect_error){ //validação para acesso ao banco de dados caso não consiga acessar


    die('Erro ao conectar ao banco de dados:'. $conn->connect_error);

    
}

?>
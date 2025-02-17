<?php


require 'conexao.php';
require 'functions.php';

if(!isset($_SESSION['usuario_id'])){
    header('Location: index.php');
    exit();
}


$produtos = vizualizarProduto($_SESSION['usuario_id'],$conn);


?>




<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Conteudo de Estoque</title>
</head>
<body>

    <h1>Tabela de produtos</h1>

    <table>
        
        <thead>

            <tr>
                <th>Codigo do Produto:</th>
                <th>Nome do Produto:</th>
                <th>Descrição</th>
                <th>Categoria</th>
                <th>Quantidade</th>
                <th>Preço</th>
                <th>Data de Entrada</th>
                <th>Data de Validade</th>
                <th>Localização no armazém</th>
                <th>Status</th>
                <th>Observações</th>
            </tr>
   
        </thead>

        <tbody>
            <?php foreach($produtos as $produto): ?>
            <tr>

                <td><?php echo $produto['codigoProduto'];?></td>
                <td><?php echo $produto['nomeProduto'];?></td>
                <td><?php echo $produto['descricaoProduto'];?></td>
                <td><?php echo $produto['categoria'];?></td>
                <td><?php echo $produto['quant'];?></td>
                <td><?php echo $produto['preco'];?></td>
                <td><?php echo $produto['dataEntrada'];?></td>
                <td><?php echo $produto['dataValidade'];?></td>
                <td><?php echo $produto['localizacao'];?></td>
                <td><?php echo $produto['stat'];?></td>
                <td><?php echo $produto['obs'];?></td>
                <td><?php echo $produto['fornecedor'];?></td>


            </tr>
            <?php endforeach; ?>


        </tbody>

    </table>


    <a href="index.php">Sair</a>

    
</body>
</html>
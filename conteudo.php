<?php


require 'conexao.php'; //importando os dados do banco de dados
require 'functions.php'; // importando as funções para serem ultilizadas

if(!isset($_SESSION['usuario_id'])){ //verificação para ver se o usuario esta logaco
    header('Location: index.php');
    exit();
}


$produtos = vizualizarProduto($_SESSION['usuario_id'],$conn); //executando a função com base na sessão do usuario


?>




<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Conteudo de Estoque</title>
</head>
<body>

    <h1 id="estoque" class="shadow p-3 mb-5 bg-white rounded">Tabela de produtos</h1>

    <table class="table table-success table-striped" id="tabela">
        
        <thead table-primary>

            <tr class="table-primary">
                <th>Codigo do Produto</th>
                <th>Nome do Produto</th>
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
        <!--ultilizando o laço foreach para percorrer o banco e exibir o resultado-->
        <tbody class="table-primary">
            <?php foreach($produtos as $produto): ?> 
            <tr class="table-primary">

                <td><?php echo $produto['id'];?></td>
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
            <?php endforeach; ?> <!--finalizando a sessão php que foi aberta com o foreach-->


        </tbody>

    </table>


    <a href="index.php">Sair</a>
    <a href="conteudo.php">Atualizar</a>

    
</body>
</html>
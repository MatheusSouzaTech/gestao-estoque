<?php

require 'conexao.php';
require 'functions.php';


if(!isset($_SESSION['usuario_id'])){

    header('Location: index.php');
    exit();
}


if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['incluir'])){

    $usuario_id = $_SESSION['usuario_id'];
    $id = $_POST['codigo'];
    $nomeProduto = $_POST['nomeProduto'];
    $descricaoProduto = $_POST['descricao'];
    $categoria = $_POST['categoria'];
    $quant = $_POST['quant'];
    $preco = $_POST['preco'];
    $dataEntrada = $_POST['entrada'];
    $dataValidade = $_POST['validade'];
    $localizacao = $_POST['local'];
    $status = $_POST['status'];
    $obs = $_POST['obs'];
    



    if(cadastrarProduto($id,$usuario_id,$nomeProduto,$descricaoProduto,$categoria,$quant,$preco,$dataEntrada,$dataValidade,$localizacao,$status,$obs,$conn)){

        $sucesso_produto = 'Produto cadastrado com sucesso!';
    }
    else{

        $erro_produto = 'Erro ao cadastrar produto, verifique as informações';
    }


}

$produtos = vizualizarProduto($_SESSION['usuario_id'],$conn);





if(isset($_GET['remover'])){
    $id = $_GET['remover'];
    if(removerProduto($id,$conn)){
        $sucesso_produto = 'Produto removido com sucesso!';
        header('Location:produtos.php');
        exit();

    }else{
        $erro_produto = 'Erro ao remover produto';
    }
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Gestão de Estoque</title>
</head>
<body>


    <h1>Gestão de Estoque</h1>

    <?php if(isset($sucesso_produto)): ?>
        <p class="sucesso"><?php echo $sucesso_produto; ?></p>
    <?php endif; ?>
    

    <?php if(isset($erro_produto)): ?>
        <p class="erro"><?php echo $erro_produto; ?></p>
    <?php endif; ?>

    


    <section class="container">


        <form method="post">

            <label for="codigo">Codigo do Produto</label>
            <input type="number" id="codigo" name="codigo" >

            <label for="nomeProduto">Nome do Produto</label>
            <input type="text" id="nomeProduto" name="nomeProduto" placeholder="Produto" >


            <label for="descricao">Descrição</label>
            <input type="text" id="descricao" name="descricao" placeholder="Descrição" >

           
            <label for="categoria">Categoria</label>
            <select name="categoria" id="categoria">

                <option value="higienicos">Higienicos</option>
                <option value="alimenticios">Alimenticios</option>
                <option value="eletronicos">Eletronicos</option>

            </select>


            <label for="quant">Quatidade de estoque: </label>
            <input type="number" id="quant" name="quant" placeholder="Quantidade" min="0" >


            <label for="preco">Preço</label>
            <input type="number" id="preco" name="preco" placeholder="Preço" >


            <label for="entrada">Data de Entrada</label>
            <input type="date" id="entrada" name="entrada" placeholder="dd/mm/aaaa" >

            <label for="validade">Data de Validade</label>
            <input type="date" id="validade" name="validade" >

            <label for="local">Localização no armazém</label>
            <input type="text" id="local" name="local" placeholder="Localização" >

            <label for="status">Status</label>
            <select name="status" id="status" >

                <option value="ativo">Ativo</option>
                <option value="inativo">Inativo</option>

            </select>

            <label for="obs">Observações</label>
            <input type="text" id="obs" name="obs" placeholder="Observações">


            <button type="submit" name="incluir">Cadastrar</button>
            
            

        </form>




    </section>

    <section class="container-tabela">
    <table>
        
        <thead>

            <tr>
                <th>ID</th>
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
                <td><?php echo $produto['id'];?></td>
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

                <td>
                    <a href="?remover=<?php echo $produto['id']; ?>"onclick="return confirm('Tem certeza?')">Remover</a>
                    <a href="editarProduto.php?id=<?php echo $produto['id'];?>">Editar</a>
                </td>


            </tr>
            <?php endforeach; ?>


        </tbody>

    </table>

    </section>
    
    
</body>
</html>
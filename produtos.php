<?php

require 'conexao.php';
require 'functions.php';


if(!isset($_SESSION['usuario_id'])){

    header('Location: index.php');
    exit();
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['incluir'])){

    $usuario_id = $_SESSION['usuario_id'];
    $codigoProduto = $_POST['codigo'];
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
    



    if(cadastrarProduto($usuario_id,$codigoProduto,$nomeProduto,$descricaoProduto,$categoria,$quant,$preco,$dataEntrada,$dataValidade,$localizacao,$status,$obs,$conn)){

        $sucesso_produto = 'Produto cadastrado com sucesso!';
    }
    else{

        $erro_produto = 'Erro ao cadastrar produto, verifique as informações';
    }


}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pesquisar'])){

    vizualizarProduto($usuario_id,$conn);

}
















?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão de Estoque</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>


    <h1>Gestão de Estoque</h1>

    <?php if(isset($sucesso_produto)): ?>
        <p class="sucesso"><?php echo $sucesso_produto; ?></p>
    <?php endif; ?>
    

    <?php if(isset($erro_produto)): ?>
        <p class="erro"><?php echo $erro_produto; ?></p>
    <?php endif; ?>

    <div class="container">


        <form method="post">

            <label for="codigo">Codigo do Produto</label>
            <input type="number" id="codigo" name=" codigo" >

            <button type="submit" name="pesquisar">Pesquisar</button>


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
            <button type="submit" name="editar">Editar</button>
            <button type="submit" name="excluirProduto">Excluir</button>

        </form>




    </div>
    
    
</body>
</html>
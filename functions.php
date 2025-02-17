<?php


session_start(); //startando a sessão para 

function cadastrarUsuario($nome,$email,$senha, $perfil, $conn){

    $senhaHash = password_hash($senha,PASSWORD_DEFAULT); //veificação e criptografia da senha

    $stmt = $conn->prepare("INSERT INTO usuarios(nome,email,senha,perfil)VALUES (?,?,?,?)"); // Prepara uma consulta SQL para inserir um novo usuário no banco de dados

    $stmt->bind_param("ssss", $nome, $email,$senhaHash,$perfil);  //Faz a vinculação e troca do valores, substituindo os "?" pelos valores das variáveis

    return $stmt->execute(); //executa a função e a consulta pedida acima

}

//função de login
function fazerLogin($email, $senha, $conn) {
    
    //preparação da consulta SQL para realizar o login

    $stmt = $conn->prepare("SELECT id, nome, senha, perfil FROM usuarios WHERE email = ?");

    $stmt->bind_param("s", $email); //vincula o parametro atraves da variavel especifica para a verificação do login valido

    $stmt->execute(); // executa a consulta SQL

    $result = $stmt->get_result(); //recebe o resultado encontrado
    $usuario = $result->fetch_assoc(); //procura o usuario com base no resultado da consulta

    if ($usuario && password_verify($senha, $usuario['senha'])) { //faz a verificação se a senha esta condizente com o usuario 

        //Armazena os dados dos usuario logado em uma variavel sessão

        $_SESSION['usuario_id'] = $usuario['id']; 
        $_SESSION['usuario_nome'] = $usuario['nome'];
        $_SESSION['usuario_perfil'] = $usuario['perfil'];
        return $_SESSION['usuario_perfil']; //retorna o tipo de perfil que esta requisitando o acesso
    }

    return false; 
}

function cadastrarProduto($usuario_id,$codigoProduto,$nomeProduto,$descricaoProduto,$categoria,$quant,$preco,$dataEntrada,$dataValidade,$localizacao,$status,$obs,$fornecedor,$conn){


    //preparação da consulta se inserção no no banco
    $stmt = $conn->prepare("INSERT INTO produtos (usuario_id, codigoProduto, nomeProduto, descricaoProduto, categoria, quant, preco, dataEntrada, dataValidade, localizacao, stat, obs,fornecedor) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");


    $stmt->bind_param("iisssidssssss", $usuario_id,$codigoProduto,$nomeProduto, $descricaoProduto, $categoria, $quant, $preco,$dataEntrada,$dataValidade,$localizacao,$status,$obs,$fornecedor);  //Faz a vinculação e troca do valores, substituindo os "?" pelos valores das variáveis dos quais os dados foram coletados

    return $stmt->execute(); //executa a ação SQL


}




function vizualizarProduto($usuario_id,$conn){

    $stmt = $conn->prepare("SELECT * FROM produtos WHERE usuario_id = ?"); // Prepara uma consulta SQL para consultar os dados no banco de dados
    $stmt->bind_param("i",$usuario_id); //vicula com base na chave estrangeira entre tabelas do banco
    $stmt->execute();
    $result = $stmt->get_result();
    
    return $result->fetch_all(MYSQLI_ASSOC);


}

function editarProduto($id, $codigoProduto, $nomeProduto, $descricaoProduto, $categoria, $quant, $preco, $dataEntrada, $dataValidade, $localizacao, $status, $obs,$fornecedor, $conn) {

    
    $stmt = $conn->prepare("UPDATE produtos SET codigoProduto=?, nomeProduto=?, descricaoProduto=?, categoria=?, quant=?, preco=?, dataEntrada=?, dataValidade=?, localizacao=?, stat=?, obs=?, fornecedor=? WHERE id=?");


    $stmt->bind_param("sssisissssssi", $codigoProduto, $nomeProduto, $descricaoProduto, $categoria, $quant, $preco, $dataEntrada, $dataValidade, $localizacao, $status, $obs,$fornecedor, $id);

   
    return $stmt->execute();
}


function removerProduto($id,$conn){
    $stmt = $conn->prepare("DELETE FROM produtos WHERE id = ?"); // Prepara uma consulta SQL para remover os dados do banco de dados atraves do id
    $stmt->bind_param("i",$id); //vicula com base no id do produto
    return $stmt->execute();

}





?>



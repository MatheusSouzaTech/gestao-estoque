<?php


session_start();

function cadastrarUsuario($nome,$email,$senha, $perfil, $conn){

    $senhaHash = password_hash($senha,PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO usuarios(nome,email,senha,perfil)VALUES (?,?,?,?)");

    $stmt->bind_param("ssss", $nome, $email,$senhaHash,$perfil);

    return $stmt->execute();

}

function fazerLogin($email, $senha, $conn) {
    
    $stmt = $conn->prepare("SELECT id, nome, senha, perfil FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();
    $usuario = $result->fetch_assoc();

    if ($usuario && password_verify($senha, $usuario['senha'])) {
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nome'] = $usuario['nome'];
        $_SESSION['usuario_perfil'] = $usuario['perfil'];
        return true; 
    }

    return false; 
}

function cadastrarProduto($usuario_id,$codigoProduto,$nomeProduto,$descricaoProduto,$categoria,$quant,$preco,$dataEntrada,$dataValidade,$localizacao,$status,$obs,$conn){

    $stmt = $conn->prepare("INSERT INTO produtos (usuario_id, codigoProduto, nomeProduto, descricaoProduto, categoria, quant, preco, dataEntrada, dataValidade, localizacao, stat, obs) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");


    $stmt->bind_param("iisssidsssss", $usuario_id,$codigoProduto,$nomeProduto, $descricaoProduto, $categoria, $quant, $preco,$dataEntrada,$dataValidade,$localizacao,$status,$obs);

    return $stmt->execute();


}




function vizualizarProduto($usuario_id,$conn){

    $stmt = $conn->prepare("SELECT * FROM produtos WHERE usuario_id = ?");
    $stmt->bind_param("i",$usuario_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    return $result->fetch_all(MYSQLI_ASSOC);


}

function editarProduto(){


}

function removerProduto($id,$conn){
    $stmt = $conn->prepare("DELETE FROM produtos WHERE id = ?");
    $stmt->bind_param("i",$id);
    return $stmt->execute();

}





?>



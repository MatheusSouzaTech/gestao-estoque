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
        return $usuario['perfil']; 
    }

    return false; 
}






?>



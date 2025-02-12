<?php

 require 'conexão.php';
 require 'functions.php';

$login_erro = '';

if($_SERVER['REQUEST_METHOD'] === 'post' && isset(($_POST['logar']))){
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    if(fazerLogin($email, $senha, $conn)){

        header('Location: conteudo.php');

    }
    else{
        $login_erro = 'Email ou senha incorretos';
    }

}



?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Login</title>
</head>
<body>

    <div class="conteiner">

        <h1>Login</h1>

        <?php if($login_erro): ?>
        <p class="erro"><?php echo $login_erro; ?></p>
        <?php endif; ?>

        <form method="post">

            <label for="email">Login</label>
            <input type="text" name="email" id="email" placeholder="email">

            <label for="senha">Senha</label>
            <input type="password" name="senha" id="senha" placeholder="senha">

            <button type="submit" name="logar">Entrar</button>
            <a href="cadastro.php">Cadastrar</a>

        </form>





    </div>
    
</body>
</html>
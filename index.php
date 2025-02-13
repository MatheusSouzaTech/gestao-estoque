<?php


require 'conexao.php';
require 'functions.php';



$login_erro = '';



if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logar'])) {

    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $perfil = $_SESSION['usuario_perfil'];

    if (fazerLogin($email, $senha, $conn)) {
        if ($perfil === 'func') { 
            header('Location: produtos.php');
            exit();
        } else if($perfil === 'admin'){
            header('Location: conteudo.html'); // Redireciona funcionário
            exit();
            
        }
    } else {

        $login_erro = 'Email ou senha incorretos';
       
    }
    
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Login</title>
</head>
<body>

    <div class="container">

        <h1>Login</h1>

        <?php if($login_erro): ?>
            <p class="erro"><?php echo $login_erro; ?></p>
        <?php endif; ?>

        <form method="post">

            <label for="email">Login</label>
            <input type="text" name="email" id="email" placeholder="email" required>

            <label for="senha">Senha</label>
            <input type="password" name="senha" id="senha" placeholder="senha" required>

            <button type="submit" name="logar">Entrar</button>
            <a href="cadastro.php">Cadastrar</a>

        </form>

    </div>
    
</body>
</html>

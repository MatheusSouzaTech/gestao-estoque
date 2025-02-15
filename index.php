<?php


require 'conexao.php';
require 'functions.php';



$login_erro = '';



if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logar'])) {

    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $perfil = $_SESSION['usuario_perfil'];

    if (fazerLogin($email, $senha, $conn)) {
        if ($perfil === 'admin') { 
            header('Location: produtos.php');
            exit();
        } else if($perfil === 'func'){
            header('Location: conteudo.php'); 
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="main.css">
    <title>Login</title>
</head>
<body>

    <div class="container">

        <h1><span class="shadow p-3 mb-5 bg-white rounded" style="background-color: #333;">Login</span></h1>

        <?php if($login_erro): ?>
            <p class="erro"><?php echo $login_erro; ?></p>
        <?php endif; ?>

        <form method="post" class="form-group">

            <label for="email">Login</label>
            <input type="text" name="email" id="email" placeholder="email" required>

            <label for="senha">Senha</label>
            <input type="password" name="senha" id="senha" placeholder="senha" required>

            <button type="submit" name="logar" class="btn btn-primary">Entrar</button>
            <a href="cadastro.php">Cadastrar</a>

        </form>

    </div>
    
</body>
</html>

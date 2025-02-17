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
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

</head>
<body>

    <div class="text-bg-light p-3 .container-fluid" id="container">

        <h1><span class="shadow p-3 mb-5 bg-white rounded" id="login">Login</span></h1>

        <?php if($login_erro): ?>
            <p class="erro"><?php echo $login_erro; ?></p>
        <?php endif; ?>

    <form >
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" aria-describedby="emailHelp">
        </div>

        <div class="mb-3">
            <label for="senha" class="form-label">Password</label>
            <input type="password" class="form-control" id="senha">
         </div>

        <button type="submit" class="btn btn-primary">Submit</button>

    </form>

    </div>
    
</body>
</html>

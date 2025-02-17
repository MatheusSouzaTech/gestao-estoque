<?php


require 'conexao.php'; //importando os dados do banco de dados
require 'functions.php'; // importando as funções para serem ultilizadas



$login_erro = '';


// verifica se a requisição foi realizada via post e se foi feita atraves no name logar
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logar'])) {

    //coleta os dados digitados nos campos do formulario
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $perfil = $_SESSION['usuario_perfil'];


    if (fazerLogin($email, $senha, $conn)) { //chama a função de fazer login e faz o redirecionamento

        if ($perfil === 'admin') { //verificação com base no perfil se for admin redireciona para uma pagina e se for funcionario ira para outra

            header('Location: produtos.php');
            exit();

        } 
        else if($perfil === 'func'){

            header('Location: conteudo.php'); 
            exit();
            
        }

    } 
    else { // caso apresente erro exibira a mensagem

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

        <form method="post" class="form-group">
            <div class="mb-3">
                <label for="email" class="form-label">Login</label>
                <input type="text" class="form-control" name="email" id="email" placeholder="email" required>

                <label for="senha" class="form-label">Senha</label>
                <input type="password" class="form-control" name="senha" id="senha" placeholder="senha" required>

                <button type="submit" name="logar" class="btn btn-primary">Entrar</button>
                <a href="cadastro.php">Cadastrar</a>
            </div>
        </form>


    </div>
    
</body>
</html>

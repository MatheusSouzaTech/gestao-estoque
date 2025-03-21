<?php

require 'conexao.php'; //importando os dados do banco de dados
require 'functions.php'; // importando as funções para serem ultilizadas

$erro_cadastro = '';
$cadastro_sucesso = '';


// verifica se a requisição foi realizada via post e se foi feita atraves no name cadastro
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cadastro'])){

    //coleta os dados digitados nos campos do formulario

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $perfil = $_POST['perfil'];

    if(cadastrarUsuario($nome, $email, $senha, $perfil,$conn)){ //chama a função de cadastro e insere todos os dados coletado do usuario no banco de dados

        $cadastro_sucesso = 'Cadastro realizado com sucesso! Faça o login.';
        
    }
    else{
        //caso apresente algum erro ele retonar a mensagem de erro
        $erro_cadastro = 'Erro ao cadastrar. Email já existe';
    }


}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Cadastro de usuarios</title>
</head>
<body>
    
    <div class="container">

        <form method="post">

            <h1>Cadastro</h1>

           <?php if($erro_cadastro): ?>
            <p class="erro"><?php echo $erro_cadastro; ?></p>
            <?php endif; ?>

        <?php if(isset($cadastro_sucesso)): ?>
            <p class="sucesso"><?php echo $cadastro_sucesso; ?></p>
            <?php endif; ?>

            <label for="nome">Nome</label>
            <input type="text" id="nome" name="nome" placeholder="Nome" required>


            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="email" required>
            

            <label for="senha">Senha</label>
            <input type="password" id="senha" name="senha" placeholder="Senha" required>

            <label for="perfil">Tipo de Perfil</label>

            <select name="perfil" id="perfil">
                <option value="admin">Administrador</option>
                <option value="func">Funcionario</option>

            </select>

            <button type="submit" name="cadastro">Cadastrar</button>
            <a href="index.php">Login</a>

        </form>


    </div>


</body>
</html>
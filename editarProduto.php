<?php

require 'conexao.php';
require 'functions.php';

if (!isset($_GET['id'])) {
    header('Location: produtos.php');
    exit();
}

$id = $_GET['id'];
$usuario_id = $_SESSION['usuario_id'];


$stmt = $conn->prepare("SELECT * FROM produtos WHERE id = ? AND usuario_id = ?");
$stmt->bind_param("ii", $id, $usuario_id);
$stmt->execute();
$result = $stmt->get_result();
$produtos = $result->fetch_assoc();

if (!$produtos) {
    header('Location: conteudo.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editar_produto'])) {

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
    $fornecedor = $_POST['fornecedor'];

    
    if (editarProduto($id, $codigoProduto, $nomeProduto, $descricaoProduto, $categoria, $quant, $preco, $dataEntrada, $dataValidade, $localizacao, $status, $obs,$fornecedor, $conn)) {
        $sucesso_edicao = 'Produto atualizado com sucesso!';
        
        $produtos['codigoProduto'] = $codigoProduto;
        $produtos['nomeProduto'] = $nomeProduto;
        $produtos['descricaoProduto'] = $descricaoProduto;
        $produtos['categoria'] = $categoria;
        $produtos['quant'] = $quant;
        $produtos['preco'] = $preco;
        $produtos['dataEntrada'] = $dataEntrada;
        $produtos['dataValidade'] = $dataValidade;
        $produtos['localizacao'] = $localizacao;
        $produtos['stat'] = $status;
        $produtos['obs'] = $obs;
        $fornecedor = $_POST['fornecedor'];
    } else {
        $erro_edicao = 'Erro ao atualizar produto';
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Editar Produto</title>
</head>
<body>

    <?php if (isset($sucesso_edicao)): ?>
        <p class="sucesso_edicao"><?php echo $sucesso_edicao; ?></p>
    <?php endif; ?>

    <?php if (isset($erro_edicao)): ?>
        <p class="erro_edicao"><?php echo $erro_edicao; ?></p>
    <?php endif; ?>

    <section class="container">
        <form method="post">

            <div class="mb-3" id="formulario">

            <label for="codigo">Código do Produto</label>
            <input type="number" id="codigo" name="codigo" value="<?php echo $produtos['codigoProduto']; ?>"class="form-control" required>


            <label for="nomeProduto">Nome do Produto</label>
            <input type="text" id="nomeProduto" name="nomeProduto" placeholder="Produto" value="<?php echo $produtos['nomeProduto']; ?>" class="form-control" required>


            <label for="descricao">Descrição</label>
            <input type="text" id="descricao" name="descricao" placeholder="Descrição" value="<?php echo $produtos['descricaoProduto']; ?>" class="form-control">


            <label for="categoria">Categoria</label>
            <select name="categoria" id="categoria" class="form-select form-select-sm">

                <option value="higienicos" <?php echo ($produtos['categoria'] == 'higienicos') ? 'selected' : ''; ?>>Higienicos</option>
                <option value="alimenticios" <?php echo ($produtos['categoria'] == 'alimenticios') ? 'selected' : ''; ?>>Alimentícios</option>
                <option value="eletronicos" <?php echo ($produtos['categoria'] == 'eletronicos') ? 'selected' : ''; ?>>Eletrônicos</option>

            </select>


            <label for="quant">Quantidade em Estoque</label>
            <input type="number" id="quant" name="quant" placeholder="Quantidade" min="0" value="<?php echo $produtos['quant']; ?>" class="form-control" required>


            <label for="preco">Preço</label>
            <input type="number" id="preco" name="preco" placeholder="Preço" value="<?php echo $produtos['preco']; ?>"class="form-control">


            <label for="entrada">Data de Entrada</label>
            <input type="date" id="entrada" name="entrada" value="<?php echo $produtos['dataEntrada']; ?>" class="form-control">


            <label for="validade">Data de Validade</label>
            <input type="date" id="validade" name="validade" value="<?php echo $produtos['dataValidade']; ?>" class="form-control">


            <label for="local">Localização no Armazém</label>
            <input type="text" id="local" name="local" placeholder="Localização" value="<?php echo $produtos['localizacao']; ?>" class="form-control">


            <label for="status">Status</label>
            <select name="status" id="status" class="form-select form-select-sm">

                <option value="ativo" <?php echo ($produtos['stat'] == 'ativo') ? 'selected' : ''; ?>>Ativo</option>
                <option value="inativo" <?php echo ($produtos['stat'] == 'inativo') ? 'selected' : ''; ?>>Inativo</option>

            </select>


            <label for="obs">Observações</label>
            <input type="text" id="obs" name="obs" placeholder="Observações" value="<?php echo $produtos['obs']; ?>" class="form-control">


            <label for="fornecedor">Fornecedor</label>
            <input type="text" id="fornecedor" name="fornecedor" placeholder="fornecedor" value="<?php echo $produtos['fornecedor'];?>" class="form-control">


            <button type="submit" name="editar_produto">Editar</button>
            <a href="produtos.php">Voltar</a>
            
            </div>
        </form>
    </section>

</body>
</html>

<?php
require_once("conexao.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $estoque = $_POST['estoque'];

    $stmt = $pdo->prepare("INSERT INTO produtos (nome, preco, estoque) VALUES (?, ?, ?)");
    if ($stmt->execute([$nome, $preco, $estoque])) {
        echo "Produto cadastrado!";
    } else {
        echo "Erro ao cadastrar produto!";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Produto</title>
    <link rel="stylesheet" href="style.css">
<form method="post">
    Nome: <input type="text" name="nome" required><br>
    Preço: <input type="number" step="0.01" name="preco" required><br>
    Estoque: <input type="number" name="estoque" required><br>
    <button type="submit">Cadastrar Produto</button>
    <a href="../index.php"><button>Voltar para o inicio</button></a>
</form>
<?php
require_once("conexao.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $admin = (isset($_POST['admin']) && strtolower(trim($_POST['admin'])) === 'sim') ? 1 : 0;
    $dados = $pdo ->prepare('INSERT INTO usuarios (nome, email, senha, admin) VALUES (:nome, :email, :senha, :admin)');
    
    if ($dados->execute([':nome' =>$nome,':email' => $email,':senha'=> $senha, ':admin' => $admin])) {
        echo "Usuário cadastrado com sucesso! <a href='login.php'>Faça login</a>";
        exit;
    } else {
        $erro = "Erro ao cadastrar usuário!";
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
<div class="registro">
    <h2>Cadastro</h2>
    <form method="post" action="registrar.php">
        <label for="name">Nome:</label>
        <input type="text" id="name" name="nome" required>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        
        <label for="password">Senha:</label>
        <input type="password" id="password" name="senha" required>

        <label for="admin">Quer ser administrador? (sim/não):</label>
        <input type="text" id="admin" name="admin" required>
        
        <button type="submit">Registrar</button>
    </form>
    <?php if (isset($erro)) echo "<p style='color:red;'>$erro</p>"; ?>
    <div class="registro-footer">
        <p><a href="../index.php">Voltar para o inicio</a></p>
</div>
</div>
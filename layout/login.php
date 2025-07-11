<?php
session_start();
require_once("conexao.php");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $dados = $pdo -> prepare('SELECT id, senha, admin FROM usuarios WHERE email = :email');
    $dados ->execute(['email' =>$email]);
    $user = $dados ->fetch();

    if ($user && password_verify($senha, $user['senha'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['admin'] = $user['admin'];
        header("Location: ../index.php");
        exit;
    } else {
        $erro = "Usuário ou senha inválidos!";
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
<div class="login">
    <h2>Login</h2>
    <h2>Entrar</h2>

<form method="post" action="login.php">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    
    <label for="senha">Senha:</label>
    <input type="password" id="senha" name="senha" required>
    
    <button type="submit">Entrar</button>
</form>
<?php if (isset($erro)) echo "<p style='color:red;'>$erro</p>"; ?>
<div class="login-footer">
    <p><a href="registrar.php">Registrar-se</a></p>
    <p><a href="../index.php">Voltar para o inicio</a></p>
</div>
</div>
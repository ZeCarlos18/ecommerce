<?php
session_start();
require_once("layout/conexao.php");

$dados = $pdo ->query("SELECT * FROM produtos");
$produtos = $dados ->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loja de Produtos</title>
    <link rel="stylesheet" href="layout/style.css">
<div>
    <h2>Seja bem vindo</h2>
    <table cellpadding="8">
        <tr>
            <th>Produto</th>
            <th>Preço</th>
            <th>Estoque</th>
        </tr>
        <?php foreach ($produtos as $produto): ?> 
        <tr>
            <td><?php echo htmlspecialchars($produto['nome']); ?></td>
            <td><?php echo "R$ " . number_format($produto['preco'], 2); ?></td>
            <td><?php echo $produto['estoque']; ?></td>
            <td><?php 
            if (isset($_SESSION['user_id'])): ?>
                <form method="post" action="layout/cart.php">
                    <input type="hidden" name="product_id" value="<?php echo $produto['id']; ?>">
                    <input type="number" name="quantity" value="1" min="1" max="<?php echo $produto['estoque']; ?>">
                    <button type="submit" name="add_to_cart">Adicionar ao carrinho</button>
                </form>
            <?php else: ?>
                <span>Faça login para comprar</span>
            <?php endif; ?>
        <?php endforeach; ?></td>
        </tr>
    </table>
    <div style="margin-top:20px;">
        <a href="layout/login.php"><button>Login</button></a>
        <a href="layout/registrar.php"><button>Registrar-se</button></a>
        <a href="layout/cart.php"><button>Ver Carrinho</button></a>
        <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1): ?>
            <a href="layout/cadastrar_produto.php"><button>Adicionar Produto</button></a>
        <?php endif; ?>
</div>
</div>
</div>
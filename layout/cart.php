<?php
session_start();
require_once("conexao.php");

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_POST['add_to_cart'])) {
    $id = $_POST['product_id'];
    $quantity = max(1, intval($_POST['quantity']));
    if (!isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id] = $quantity;
    } else {
        $_SESSION['cart'][$id] += $quantity;
    }
}

echo "<h2>Seu Carrinho</h2>";
$total = 0;
foreach ($_SESSION['cart'] as $id => $qtd) {
    $dados = $pdo->prepare("SELECT * FROM produtos WHERE id = ?");
    $dados ->execute([$id]);
    $produto = $dados->fetch(PDO::FETCH_ASSOC);
    if ($produto) {
        echo htmlspecialchars($produto['nome']) . " - Quantidade: $qtd<br>";
        $total += $produto['preco'] * $qtd;
    }
}
echo "<strong>Total: R$ " . number_format($total, 2) . "</strong>";

if ($total > 0) {
    echo '<form method="post"><button type="submit" name="checkout">Finalizar Pedido</button></form>';
}

if (isset($_POST['checkout'])) {
    echo "<script>alert('Pedido finalizado com sucesso!');</script>";
    $_SESSION['cart'] = [];
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Produto</title>
    <link rel="stylesheet" href="style.css">
<a href="../index.php"><button>Voltar para loja</button></a>
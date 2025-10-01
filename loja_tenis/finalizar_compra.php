<?php 
session_start();

// Garantimos que a variável do carrinho exista (mesmo que vazia)
if (!isset($_SESSION['cart'])) { 
    $_SESSION['cart'] = []; 
} 

// Verifique se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Armazena as informações do cliente na sessão
    $_SESSION['order'] = [
        'cliente' => [
            'nome' => $_POST['nome'],
            'email' => $_POST['email'],
            'endereco' => $_POST['endereco'],
            'cidade' => $_POST['cidade'],
            'cep' => $_POST['cep'],
        ],
        'forma_pagamento' => $_POST['pagamento'],
        'itens' => $_SESSION['cart'],
        'total' => 0, // O total será calculado na página de comprovante
        'order_number' => uniqid('ORD-'), // Gera um número de pedido único
        'date' => date('Y-m-d H:i:s'), // Data da compra
    ];

    // Calcula o total
    foreach ($_SESSION['cart'] as $item) {
        $_SESSION['order']['total'] += $item['valor'] * $item['quantidade'];
    }

    // Redireciona para a página de comprovante
    header('Location: comprovante.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Finalizar Compra</title>
    <style>
        body {
            width: 100%;
            min-height: 1400px;
            background-color: white;
            color: white;
            font-size: 25px;
            padding-top: 10px; 
        }
        .container {
            width: 80%;
            margin: 20px auto;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.5);
        }
        h1 {
            text-align: center;
            font-size: 36px;
            margin-bottom: 20px;
            color: white;
        }
        .pedido {
            margin: 20px 0;
        }
        .pedido-item {
            border-bottom: 1px solid white;
            padding: 10px 0;
        }
        .total {
            text-align: right;
            font-size: 24px;
            margin-top: 20px;
            color: #f0f0f0;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #fff;
        }
        .form-group input, .form-group select {
            width: 98%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 10px;
            font-size: 16px;
            color: #333;
        }
        .btn {
            display: block;
            width: 100%;
            background-color: rgb(37, 206, 37);
            color: white;
            text-align: center;
            padding: 10px;
            border-radius: 5px;
            margin-top: 20px;
            font-size: 16px;
            cursor: pointer;
            border: none;
        }
        .error {
            color: red;
            font-size: 16px;
            margin-bottom: 10px;
        }
        .link-voltar {
            text-align: center;
            margin-top: 20px;
        }
        .link-voltar a {
            text-decoration: none;
            color: #fff;
        }
        .link-voltar a:hover {
            text-decoration: underline;
        }
        /* Estilos para o resumo do pedido */
        .produto {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            padding: 10px;
            border-bottom: 1px solid white;
        }
        .produto img {
            width: 100px;
            height: auto;
            margin-right: 20px;
            border-radius: 10px;
        }
        .info {
            flex-grow: 1;
        }
        .info strong {
            font-size: 18px;
            color: #f0f0f0;
        }
        .info .quantidade {
            display: inline-block;
            width: 40px;
            text-align: center;
            font-size: 16px;
            margin: 0 10px;
            color: #f0f0f0;
        }
        .botoes {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .btn-plus {
            background-color: rgb(37, 206, 37);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.2);
        }
        .btn-minus {
            background-color: rgb(255, 0, 0);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Finalizar Compra</h1>
        
        <?php if (count($_SESSION['cart']) == 0): ?>
            <p style="text-align:center; color:#fff;">Seu carrinho está vazio. Por favor, adicione produtos antes de finalizar a compra.</p>
        <?php else: ?>
            <h2>Resumo do Pedido</h2>
            <div class="pedido">
                <?php foreach ($_SESSION['cart'] as $item): ?>
                    <div class="pedido-item">
                        <strong><?php echo htmlspecialchars($item['nome']); ?></strong><br>
                        Quantidade: <?php echo $item['quantidade']; ?><br>
                        Preço Unitário: R$ <?php echo number_format($item['valor'], 2, ',', '.'); ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="total">
                <?php
                $totalValue = 0;
                foreach ($_SESSION['cart'] as $item) {
                    $totalValue += $item['valor'] * $item['quantidade'];
                }
                ?>
                Total: R$ <?php echo number_format($totalValue, 2, ',', '.'); ?>
            </div>
        <?php endif; ?>

        <h2>Informações do Cliente</h2>
        <form method="post">
            <div class="form-group">
                <label for="nome">Nome Completo:</label>
                <input type="text" name="nome" id="nome" required>
            </div>
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div class="form-group">
                <label for="endereco">Endereço:</label>
                <input type="text" name="endereco" id="endereco" required>
            </div>
            <div class="form-group">
                <label for="cidade">Cidade:</label>
                <input type="text" name="cidade" id="cidade" required>
            </div>
            <div class="form-group">
                <label for="cep">CEP:</label>
                <input type="text" name="cep" id="cep" required>
            </div>
            <div class="form-group">
                <label for="pagamento">Forma de Pagamento:</label>
                <select name="pagamento" id="pagamento" required>
                    <option value="">Selecione</option>
                    <option value="Cartão de Crédito">Cartão de Crédito</option>
                    <option value="Boleto Bancário">Boleto Bancário</option>
                    <option value="Cartão de Débito">Cartão de Débito</option>
                    <option value="Pix">Pix</option>
                </select>
            </div>
            <button type="submit" class="btn">Confirmar Compra</button>
        </form>

        <div class="link-voltar">
            <a href="carrinho.php">Voltar ao Carrinho</a>
        </div>
    </div>
</body>
</html>

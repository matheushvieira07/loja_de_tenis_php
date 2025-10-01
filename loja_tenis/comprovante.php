<?php
session_start();

// Verifica se a sessão 'order' existe
if (!isset($_SESSION['order'])) {
    // Redireciona para a página de finalização de compra caso não exista
    header('Location: finalizar_compra.php');
    exit;
}

// Extrai as informações do pedido e limpa a sessão para evitar reprocesamento
$order = $_SESSION['order'];
unset($_SESSION['order']);


date_default_timezone_set('America/Sao_Paulo'); // Define o fuso horário para o Brasil


?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Comprovante de Compra</title>
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background-color:#808080;
            margin: 0;
            padding: 70px;
        }
        .container {
            background-color: #fff;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            max-width: 100px;
            margin-bottom: 10px;
        }
        .header h1 {
            margin: 0;
        }
        .order-info, .customer-info, .items {
            margin-bottom: 20px;
        }
        .order-info p, .customer-info p {
            margin: 5px 0;
        }
        .items table {
            width: 100%;
            border-collapse: collapse;
        }
        .items th, .items td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        .items th {
            background-color:LightGrey;
        }
        .total {
            text-align: right;
            font-size: 20px;
            margin-top: 10px;
        }
        .link-voltar {
            text-align: center;
            margin-top: 20px;
        }
        .link-voltar a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }

        .total{
            color: black;
        }
        
    </style>
        
        

    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="css/logo.png" alt="Logo da LC Imports">
            <h1>Comprovante de Compra</h1>
            <p><strong>Nº do Pedido:</strong> <?php echo htmlspecialchars($order['order_number']); ?></p>
            <p><strong>Data da Compra:</strong> <?php echo date('d/m/Y H:i:s', strtotime($order['date'])); ?></p>

        </div>
        <div class="customer-info">
            <h2>Informações do Cliente</h2>
            <p><strong>Nome:</strong> <?php echo htmlspecialchars($order['cliente']['nome']); ?></p>
            <p><strong>E-mail:</strong> <?php echo htmlspecialchars($order['cliente']['email']); ?></p>
            <p><strong>Endereço:</strong> <?php echo htmlspecialchars($order['cliente']['endereco']); ?></p>
            <p><strong>Cidade/CEP:</strong> <?php echo htmlspecialchars($order['cliente']['cidade'] . ' - ' . $order['cliente']['cep']); ?></p>
            <p><strong>Forma de Pagamento:</strong> <?php echo htmlspecialchars($order['forma_pagamento']); ?></p>
        </div>
        <div class="items">
            <h2>Itens Comprados</h2>
            <table>
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Preço Unitário</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($order['itens'] as $item): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($item['nome']); ?></td>
                            <td><?php echo intval($item['quantidade']); ?></td>
                            <td>R$ <?php echo number_format($item['valor'], 2, ',', '.'); ?></td>
                            <td>R$ <?php echo number_format($item['valor'] * $item['quantidade'], 2, ',', '.'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="total">
            <p><strong>Total:</strong> R$ <?php echo number_format($order['total'], 2, ',', '.'); ?></p>
        </div>
        <div class="link-voltar">
            <a href="painel.php">Voltar às Compras</a>
        </div>
    </div>
</body>
</html>

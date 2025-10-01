<?php
session_start();

// Processa a requisição POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        // Limpa o carrinho
        if ($action === 'limpar') {
            $_SESSION['cart'] = [];
        } elseif ($action === 'plus') {
            $produto = $_POST['produto'];
            if (isset($_SESSION['cart'][$produto])) {
                $_SESSION['cart'][$produto]['quantidade']++;
            }
        } elseif ($action === 'minus') {
            $produto = $_POST['produto'];
            if (isset($_SESSION['cart'][$produto])) {
                $_SESSION['cart'][$produto]['quantidade']--;
                if ($_SESSION['cart'][$produto]['quantidade'] < 1) {
                    unset($_SESSION['cart'][$produto]);
                }
            }
        }
    } elseif (isset($_POST['produto'])) {
        $produto   = $_POST['produto'];
        $nome      = $_POST['nome'];
        $valor     = floatval($_POST['valor']);
        $imagem    = $_POST['imagem'];
        $quantidade = 1;

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        if (isset($_SESSION['cart'][$produto])) {
            $_SESSION['cart'][$produto]['quantidade']++;
        } else {
            $_SESSION['cart'][$produto] = [
                'nome'       => $nome,
                'valor'      => $valor,
                'imagem'     => $imagem,
                'quantidade' => $quantidade
            ];
        }
    }
  
    // Redireciona para a mesma página para evitar a re-submissão dos dados
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Carrinho de Compras</title>
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
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }
        h1 {
            text-align: center;
            font-size: 36px;
            margin-bottom: 20px;
            color: white;
        }
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
        .info form {
            display: inline-block;
            margin-left: 10px;
        }
        .info strong {
            font-size: 18px;
            color: #f0f0f0;
        }
        .total {
            text-align: right;
            font-size: 24px;
            margin-top: 20px;
            color: #f0f0f0;
        }
        .botoes {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .btn {
            background-color: rgb(37, 206, 37);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.2);
        }
        .btn- {
            background-color: rgb(255, 0, 0);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.2);
        }
        .btn.limpar {
            background-color: rgb(255, 0, 0);
        }
        .quantidade {
            display: inline-block;
            width: 40px;
            text-align: center;
            font-size: 16px;
            margin: 0 10px;
            color: #f0f0f0;
        }
        a {
            color: white;
            text-decoration: none;
            font-size: 18px;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Carrinho de Compras</h1>
        <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
            <?php $total = 0; ?>
            <?php foreach ($_SESSION['cart'] as $codigo => $item): ?>
                <div class="produto">
                    <img src="<?php echo htmlspecialchars($item['imagem']); ?>" alt="<?php echo htmlspecialchars($item['nome']); ?>">
                    <div class="info">
                        <strong><?php echo htmlspecialchars($item['nome']); ?></strong><br>
                        Preço Unitário: R$ <?php echo number_format($item['valor'], 2, ',', '.'); ?><br>
                        Quantidade: <span class="quantidade"><?php echo $item['quantidade']; ?></span>
                        <!-- Botões para aumentar e diminuir -->
                        <form method="post" action="carrinho.php" style="display:inline;">
                            <input type="hidden" name="produto" value="<?php echo $codigo; ?>">
                            <button type="submit" name="action" value="plus" class="btn">+</button>
                        </form>
                        <form method="post" action="carrinho.php" style="display:inline;">
                            <input type="hidden" name="produto" value="<?php echo $codigo; ?>">
                            <button type="submit" name="action" value="minus" class="btn-">-</button>
                        </form>
                    </div>
                </div>
                <?php $total += $item['valor'] * $item['quantidade']; ?>
            <?php endforeach; ?>
            <div class="total">
                Total: R$ <?php echo number_format($total, 2, ',', '.'); ?>
            </div>
        <?php else: ?>
            <p style="text-align: center;">Seu carrinho está vazio.</p>
        <?php endif; ?>
        
        <div class="botoes">
            <!-- Formulário para limpar o carrinho -->
            <form method="post" action="carrinho.php">
                <input type="hidden" name="action" value="limpar">
                <button type="submit" class="btn limpar">Limpar Carrinho</button>
            </form>
            <!-- Link para finalizar a compra -->
            <a href="finalizar_compra.php" class="btn">Finalizar Compra</a>
        </div>
        
        <br>
        <div style="text-align: center;">
            <a href="painel.php">Continuar Comprando</a>
        </div>
    </div>
</body>
</html>

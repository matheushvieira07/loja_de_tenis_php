<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LC Pisants - Loja</title>
    <style>
        .box {
            width: 100%;
            height: 70px;
            background-color: black;
            color: white;
            display: flex;
            font-size: 30px;
            padding-top: 10px;
        }
        .logo {
            width: 50px;
            height: 50px;
            padding-left: 50px;
            padding-top: 5px;
        }
        .lc {
            padding-top: 10px;
            padding-left: 20px;
            padding-right: 1100px;
        }
        .imgcarrinho {
            width: 50px;
            height: 50px;
            padding-top: 0.7px;
        }
        .carrinho {
            width: 50px;
            height: 50px;
        }
        .sair {
            padding-top: 10px;
            padding-left: 20px;
        }
        .corpo {
            width: 100%;
            min-height: 1400px;
            background: linear-gradient(to right, white, gray);
            color: white;
            font-size: 30px;
            padding-top: 10px; 
        }
        .secao1, .secao2, .secao3 {
            display: flex;
            margin-top: 50px;
            justify-content: center;
            
        }
        .produto-card {
            width: 200px;
            height: 300px;
            margin: 50px;
            background-color: DimGray;
            border-radius: 20px;
            text-align: center;
            font-size: 15px;
            color: white;
            padding-bottom: 20px;
        }
        .produto-card img {
            width: 180px;
            height: 180px;
            margin: 10px;
            border-radius: 20px;
        }
        .botaoComprar {
            background-color: rgb(37, 206, 37);
            width: 100px;
            height: 30px;
            border: none;
            border-radius: 20px;
            cursor: pointer;
        }
        .botaoEsg {
            background-color: rgb(255, 0, 0);
            width: 100px;
            height: 30px;
            border: none;
            border-radius: 20px;
            cursor: not-allowed;
        }
        .rodape {
            width: 100%;
            height: 50px;           
            text-align: center;
            background-color: black;
            color: white;
            display: flex;
        }
        .copyright {
            padding-left: 50px;
        }
        .telefone {
            padding-left: 500px;
        }
        .email {
            padding-left: 50px;
            padding-right: 450px;
        }
    </style>
</head>
<body>
    <header>
        <div class="box">
            <img class="logo" src="css/logo.png" alt="Logo">
            <div class="lc">LC Pisants</div>
            <a class="carrinho" href="carrinho.php"><img class="imgcarrinho" src="css/carrinho (3).png" alt="Carrinho"></a>
            <a href="index.php" class="sair" style="color:white">Sair</a>
        </div> 
    </header>  

    <section>
        <div class="corpo">
            <!-- Seção 1 -->
            <div class="secao1">
                <div class="produto-card">
                    <img src="css/tenis air max.png" alt="Tênis Air Max">
                    <p>Tênis Air Max<br>R$ 499,90</p>
                    <form method="post" action="carrinho.php">
                        <input type="hidden" name="produto" value="air_max">
                        <input type="hidden" name="nome" value="Tênis Air Max">
                        <input type="hidden" name="valor" value="499.90">
                        <input type="hidden" name="imagem" value="css/tenis air max.png">
                        <button class="botaoComprar" type="submit">Comprar</button>
                    </form>
                </div>
                <div class="produto-card">
                    <img src="css/tenis adidas ultraboost.png" alt="Tênis Adidas Ultraboost">
                    <p>Tênis Adidas Ultraboost<br>R$ 450,00</p>
                    <form method="post" action="carrinho.php">
                        <input type="hidden" name="produto" value="adidas_ultraboost">
                        <input type="hidden" name="nome" value="Tênis Adidas Ultraboost">
                        <input type="hidden" name="valor" value="450.00">
                        <input type="hidden" name="imagem" value="css/tenis adidas ultraboost.png">
                        <button class="botaoComprar" type="submit">Comprar</button>
                    </form>
                </div>
                <div class="produto-card">
                    <img src="css/tenis Puma Suede classic.png" alt="Tênis Puma Suede Classic">
                    <p>Tênis Puma Suede Classic<br>R$ 299,90</p>
                    <form method="post" action="carrinho.php">
                        <input type="hidden" name="produto" value="puma_suede_classic">
                        <input type="hidden" name="nome" value="Tênis Puma Suede Classic">
                        <input type="hidden" name="valor" value="299.90">
                        <input type="hidden" name="imagem" value="css/tenis Puma Suede classic.png">
                        <button class="botaoComprar" type="submit">Comprar</button>
                    </form>
                </div>
            </div>
            <!-- Seção 2 -->
            <div class="secao2">
                <div class="produto-card">
                    <img src="css/tenis Vans Old Skool.png" alt="Tênis Vans Old Skool">
                    <p>Tênis Vans Old Skool<br>R$ 349,90</p>
                    <form method="post" action="carrinho.php">
                        <input type="hidden" name="produto" value="vans_old_skool">
                        <input type="hidden" name="nome" value="Tênis Vans Old Skool">
                        <input type="hidden" name="valor" value="349.90">
                        <input type="hidden" name="imagem" value="css/tenis Vans Old Skool.png">
                        <button class="botaoComprar" type="submit">Comprar</button>
                    </form>
                </div>
                <div class="produto-card">
                    <img src="css/Tênis ADI2000 Adidas.png" alt="Tênis ADI2000 Adidas">
                    <p>Tênis ADI2000 Adidas<br>R$ 799,99</p>
                    <button class="botaoEsg" disabled>Esgotado</button>
                </div>
                <div class="produto-card">
                    <img src="css/Tênis Asics Gel Kayano.png" alt="Tênis Asics Gel Kayano">
                    <p>Tênis Asics Gel Kayano<br>R$ 389,90</p>
                    <form method="post" action="carrinho.php">
                        <input type="hidden" name="produto" value="asics_gel_kayano">
                        <input type="hidden" name="nome" value="Tênis Asics Gel Kayano">
                        <input type="hidden" name="valor" value="389.90">
                        <input type="hidden" name="imagem" value="css/Tênis Asics Gel Kayano.png">
                        <button class="botaoComprar" type="submit">Comprar</button>
                    </form>
                </div>
            </div>
            <!-- Seção 3 -->
            <div class="secao3">
                <div class="produto-card">
                    <img src="css/Tênis Reebok Classic Leather.png" alt="Tênis Reebok Classic Leather">
                    <p>Tênis Reebok Classic Leather<br>R$ 429,90</p>
                    <form method="post" action="carrinho.php">
                        <input type="hidden" name="produto" value="reebok_classic_leather">
                        <input type="hidden" name="nome" value="Tênis Reebok Classic Leather">
                        <input type="hidden" name="valor" value="429.90">
                        <input type="hidden" name="imagem" value="css/Tênis Reebok Classic Leather.png">
                        <button class="botaoComprar" type="submit">Comprar</button>
                    </form>
                </div>
                <div class="produto-card">
                    <img src="css/Tênis New Balance 574.png" alt="Tênis New Balance 574">
                    <p>Tênis New Balance 574<br>R$ 450,00</p>
                    <form method="post" action="carrinho.php">
                        <input type="hidden" name="produto" value="new_balance_574">
                        <input type="hidden" name="nome" value="Tênis New Balance 574">
                        <input type="hidden" name="valor" value="450.00">
                        <input type="hidden" name="imagem" value="css/Tênis New Balance 574.png">
                        <button class="botaoComprar" type="submit">Comprar</button>
                    </form>
                </div>
                <div class="produto-card">
                    <img src="css/Converse Chuck Taylor.png" alt="Tênis Converse Chuck Taylor">
                    <p>Tênis Converse Chuck Taylor<br>R$ 500,00</p>
                    <form method="post" action="carrinho.php">
                        <input type="hidden" name="produto" value="converse_chuck_taylor">
                        <input type="hidden" name="nome" value="Tênis Converse Chuck Taylor">
                        <input type="hidden" name="valor" value="500.00">
                        <input type="hidden" name="imagem" value="css/Converse Chuck Taylor.png">
                        <button class="botaoComprar" type="submit">Comprar</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    
    <footer>
        <div class="rodape">
            <p class="telefone">Contato (47) 3350-8420</p>
            <p class="copyright">@copyright LC Pisants</p>
            <p class="email">Email: LCpisants@gmail.com</p>
         </div>   
    </footer>            
</body>
</html>

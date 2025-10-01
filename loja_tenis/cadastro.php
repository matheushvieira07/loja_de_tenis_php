<?php
include('connect.php');

if(isset($_POST['usuario']) && isset($_POST['email']) && isset($_POST['senha'])) {
    $usuario = $mysqli->real_escape_string($_POST['usuario']);
    $email = $mysqli->real_escape_string($_POST['email']);
    $senha = $mysqli->real_escape_string($_POST['senha']);

    // Insere os dados na tabela de usuários
    $sql_code = "INSERT INTO usuarios (usuario, senha, email) VALUES ('$usuario', '$senha', '$email')";
    $sql_query = $mysqli->query($sql_code);

    if($sql_query) {
        echo "Usuário cadastrado com sucesso!";
        header("Location: index.php"); // Redireciona para a tela de login
        exit();
    } else {
        echo "Erro ao cadastrar o usuário: " . $mysqli->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-image: linear-gradient(45deg, black, red);
        }
        .tela-login {
            background-color: rgba(0, 0, 0, 0.8);
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 60px;
            border-radius: 30px;
            color: whitesmoke;
        }
        input {
            padding: 16px;
            border: none;
            outline: none;
            font-size: 18px;
            border-radius: 12px;
        }
        button {
            background-color: dodgerblue;
            border: none;
            outline: none;
            padding: 16px;
            width: 100%;
            border-radius: 12px;
            color: white;
            font-size: 20px;
        }
        button:hover {
            background-color: deepskyblue;
            cursor: pointer;
        }
    </style>
</head>
<body>
<div class="tela-login">
    <h1>Cadastrar Conta</h1>
    <form action="" method="POST">
        <input type="text" name="usuario" placeholder="Digite seu usuário">
        <br><br>      
        <input type="password" name="senha" placeholder="Digite a senha">
        <br><br>
        <input type="email" name="email" placeholder="Digite o email">
        <br><br>   
        <button type="submit">Cadastrar</button>   
    </form>
</div>
</body>
</html>



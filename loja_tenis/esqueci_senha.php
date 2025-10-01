<?php
include('connect.php');
if (isset($_POST['usuario']) && isset($_POST['senha'])) {

    if (strlen(trim($_POST['usuario'])) == 0) {
        echo "Usuário não informado.";
    } else if (strlen(trim($_POST['senha'])) == 0) {
        echo "Preencha a nova senha.";
    } else {
        $usuario = $mysqli->real_escape_string($_POST['usuario']);
        $senha = $mysqli->real_escape_string($_POST['senha']);

        // Corrigido o nome da tabela de 'usuario' para 'usuarios'
        $sql_code = "UPDATE usuarios SET senha = '$senha' WHERE usuario = '$usuario'";
        $sql_query = $mysqli->query($sql_code);

        if ($mysqli->affected_rows > 0) {
            echo "Senha atualizada com sucesso!";

            header("Location: index.php");
            exit();
        } else {
            echo "Erro ao atualizar a senha ou usuário não encontrado.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nova senha</title>
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
    <h1>Redefinir senha</h1>
    <form action="" method="POST">
      <input type="text" name="usuario" placeholder="Digite seu usuário">
      <br><br>
      <input type="password" name="senha" placeholder="Digite a nova senha">
      <br><br>
      <button type="submit">Redefinir</button>
    </form>
  </div>
</body>
</html>

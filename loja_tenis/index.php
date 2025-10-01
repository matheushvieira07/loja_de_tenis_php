<?php
include('connect.php');
$erroCadastro = "";

if (isset($_POST['usuario']) && isset($_POST['senha'])) {
    if (isset($_POST['cadastrar'])) {
        if (strlen(trim($_POST['usuario'])) == 0) {
            $erroCadastro .= "Usuário não informado<br>";
        }
        if (strlen(trim($_POST['senha'])) == 0) {
            $erroCadastro .= "Preencha sua senha<br>";
        }

        if ($erroCadastro == "") {
            header("Location: cadastro.php");
            exit();
        }
    } elseif (isset($_POST['entrar'])) {
        $usuario_input = $mysqli->real_escape_string($_POST['usuario']);
        $senha_input   = $mysqli->real_escape_string($_POST['senha']);
        $sql_code = "SELECT * FROM usuarios WHERE usuario = '$usuario_input' AND senha = '$senha_input'";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);

        if ($sql_query->num_rows == 1) {
            session_start();
            $usuario = $sql_query->fetch_assoc();
            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];

            if (isset($_POST['remember'])) {
                setcookie("id", $usuario['id'], time() + (86400 * 30), "/");
                setcookie("nome", $usuario['nome'], time() + (86400 * 30), "/");
            }

            header("Location: painel.php");
            exit();
        } else {
            $erroCadastro = "Falha ao logar! Usuário ou senha incorretos";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <style>
    body {
      font-family: Arial, Helvetica, sans-serif;
      background-image: linear-gradient(45deg, white, black);
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
    .esqsenha {
      padding-left: 25px;                   
    }
    .lembrardemim {
      padding-right: 35px;
    }
    .box {
      font-size: 11px; 
    }
    .erro {
      margin-top: 10px;
      color:rgb(255, 0, 0);
      font-size: 12px;
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="tela-login">
    <h1>Login</h1>
    <form action="" method="POST">
      <br>
      <input type="text" name="usuario" placeholder="Usuário">
      <br><br>      
      <input type="password" name="senha" placeholder="Senha">
      <br><br>   
      <div class="box">
        <input type="checkbox" name="remember" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Lembrar de mim</label>
        <a href="esqueci_senha.php" style="color: white" class="esqsenha">Esqueci minha senha</a>
      </div>
      <br>
      <button type="submit" name="entrar">Entrar</button>
      <br><br>
      <button type="submit" name="cadastrar">Cadastrar</button>
      <br><br>
      <?php
      if (!empty($erroCadastro)) {
          echo '<div class="erro">' . $erroCadastro . '</div>';
      }
      ?>
    </form>
  </div>
</body>
</html>

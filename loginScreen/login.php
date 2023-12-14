<?php
require_once "DataBaseLogin.php";
$p = new DataBaseLogin("127.0.0.1", 'root', '', 'projeto_catarinoVeiculos');
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Faça o seu Login</title>
  <link rel="stylesheet" href="../components/header/header.css">
  <link rel="stylesheet" href="../components/footer/footer.css">
  <link rel="stylesheet" href="./login.css">
  <link rel="stylesheet" href="../index.css">
  <link rel="stylesheet" href="../reset.css">
</head>

<body>
  <header class="container_header">
    <?php
    include "../components/header/header.php"
    ?>
  </header>

  <main>

    <sectio class="container_login login_enter">

      <h3>Login</h3>

      <?php
      if (isset($_POST["submit"])) {
        $email = addslashes(strtolower($_POST["email"]));
        $password = $_POST["password"];
        $res = $p->selectOneData($email, $password);
        if ($res) {
          session_start();
          $_SESSION['username'] = $res["name"];
          header("Location:adminPage.php");
        } else {
          echo "<p id='lgError'>Login Incorreto</p>";
        }
      }
      ?>

      <form action="login.php" method="post" name="f_login" id="f_login">

        <label for="email">E-mail: </label>
        <input type="email" name="email" id="email" placeholder="Digite o seu E-mail">

        <label for="password">Senha: </label>
        <input type="password" name="password" id="password" placeholder="Digite a sua Senha">

        <input type="submit" name="submit" value="ENTRAR" class="login_button">
      </form>
      <span>Não tem cadastro? <button class="btn_register">Cadastre-se</button> </span>
    </sectio>

    <sectio class="container_login register">
      <h3>Cadastre-se</h3>
      <form action="#" method="post" name="" id="">
        <label for="">Nome:</label>
        <input type="text" name="name" id="name" placeholder="Digite o seu nome">

        <label for="email-register">E-mail: </label>
        <input type="email" name="email" id="email_register" placeholder="Digite o seu E-mail">

        <label for="password">Senha: </label>
        <input type="password" name="password" id="password-register" placeholder="Digite a sua Senha">

        <label for="password">Repita sua Senha: </label>
        <input type="password" name="password" id="password_register_repite" placeholder="Digite a sua Senha">

        <input type="submit" value="CADASTRAR" class="register_button">
      </form>
      <span>Já tem uma conta? <button class="btn_login">Faça Login</button> </span>
    </sectio>
  </main>


  <footer class="container_footer">
    <?php
    include "../components/footer/footer.html";
    ?>
  </footer>

  <script src="./script_login.js"></script>
</body>

</html>
<?php
require "securityCode.php";
require_once "DataBaseCollaborators.php";
$p = new DataBaseCollaborators("127.0.0.1", 'root', '', 'projeto_catarinoVeiculos');
$p->createTable();
$verifica = $p->selectDataAll();
if (!$verifica) {
  $p->insertData("Rafael", "rafael@employees.com.br", "12345678", 1);
}
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

    <sectio class="genericForm">

      <h3>Login</h3>

      <?php
      if (isset($_POST["submit"])) {
        $email = addslashes(strtolower($_POST["email"]));
        $password = $_POST["password"];
        $res = $p->selectDataLogin($email, $password);
        if ($res) {
          $key = createSecurityKey();
          session_start();
          $_SESSION['numlogin'] = $key;
          $_SESSION['username'] = $res["name"];
          $_SESSION['access'] = $res["access"]; //0==restrito / 1==Total;
          header("Location:adminPage.php?num=$key");
        } else {
          echo "<p class='message'>Login Incorreto</p>";
        }
      }
      ?>

      <form action="login.php" method="post" name="f_login" id="f_login">

        <label for="email">E-mail: </label>
        <input type="email" name="email" id="email" placeholder="Digite o seu E-mail" required>

        <label for="password">Senha: </label>
        <input type="password" name="password" id="password" placeholder="Digite a sua Senha" required>

        <input type="submit" name="submit" value="ENTRAR" class="generic_btn">
      </form>

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
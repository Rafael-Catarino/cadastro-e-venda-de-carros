<?php
require_once "DataBaseCollaborators.php";
$c = new DataBaseCollaborators("127.0.0.1", "root", "", "projeto_catarinoVeiculos");

session_start();
if (isset($_SESSION["numlogin"])) {
  if ($_SESSION["numlogin"] != $_GET["num"]) {
    echo $_SESSION["numlogin"];
    echo "<p>Login não efetuado</p>";
    exit;
  }
} else {
  echo "<p>Login não efetuado</p>";
  exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../components/header/header.css">
  <link rel="stylesheet" href="../components/footer/footer.css">
  <link rel="stylesheet" href="./genericForm.css">
  <link rel="stylesheet" href="../reset.css">
  <title>Cadastro de funcionário</title>
</head>

<body>
  <header class="container_header">
    <?php
    include "../components/header/header.php";
    ?>
  </header>

  <main>
    <section class="genericForm">
      <h3>Novo de Usuário</h3>

      <?php
      if (isset($_GET["btn_form"])) {
        $userName = strtoupper($_GET["username"]);
        $userEmail = strtolower($_GET["user_email"]);
        $userPassword = $_GET["user_password"];
        $userAccess = $_GET["user_access"];
        $res = $c->selectDataRegister($userName, $userEmail, $userPassword, $userAccess);
        if ($res) {
          echo "<p class=message>Funcionário já cadastrado tente outro</p>";
        } else {
          $c->insertData($userName, $userEmail, $userPassword, $userAccess);
          echo "<p class=message>Cadastro realizado com sucesso</p>";
        }
      }
      ?>

      <form name="f_new_collaborator" action="newCollaborator.php" method="get">

        <input type="hidden" name="num" value="<?php echo $_GET["num"]; ?>">

        <label for="username">Nome:</label>
        <input type="text" id="username" name="username" maxlength="30" size="30" placeholder="Nome" required>

        <label for="user_email">E-mail:</label>
        <input type="email" id="user_email" name="user_email" maxlength="30" size="30" placeholder="E-mail" required>

        <label for="user_password">Senha:</label>
        <input type="password" id="user_password" name="user_password" maxlength="30" placeholder="Senha" size="30" required>

        <label for="user_access">Acesso:</label>
        <input type="text" id="user_access" name="user_access" maxlength="1" size="1" pattern="[0-1]+$" placeholder="0 ou 1" required>

        <input type="submit" name="btn_form" value="Cadastar" class="generic_btn">

        <a href="adminPage.php?num=<?php echo $_GET["num"]; ?>">Voltar</a>

      </form>
    </section>
  </main>

  <footer class="container_footer">
    <?php
    include "../components/footer/footer.html";
    ?>
  </footer>
</body>

</html>
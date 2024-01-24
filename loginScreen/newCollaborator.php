<?php
require_once "../Database/TB_collaborators.php";
$c = new Collaborators("127.0.0.1", "root", "", "projeto_catarinoVeiculos");

session_start();
if (isset($_SESSION["numlogin"])) {
  if ($_SESSION["numlogin"] != $_GET["num"]) {
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
  <link rel="stylesheet" href="./newCollaborator.css">
  <link rel="stylesheet" href="../reset.css">
  <title>Cadastro de Usuários</title>
</head>

<body>
  <header class="container_header">
    <?php
    include "../components/header/header.php";
    ?>
  </header>

  <main>
    <section class="newCollaborator">
      <h1>Novo de Usuário</h1>

      <?php
      if (isset($_GET["btn_form"])) {
        $userName = addslashes(ucfirst($_GET["username"]));
        $userEmail = addslashes(strtolower($_GET["user_email"]));
        $userPassword = addslashes($_GET["user_password"]);
        $userAccess = addslashes($_GET["user_access"]);
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

        <div>
          <label for="username">Nome:</label>
          <input class="input_form_generic" type="text" id="username" name="username" maxlength="30" size="30" placeholder="Nome" required value="<?php if (isset($_GET["btn_form"])) {
                                                                                                                                                    echo $userName;
                                                                                                                                                  } ?>">
        </div>

        <div>
          <label for="user_email">E-mail:</label>
          <input class="input_form_generic" type="email" id="user_email" name="user_email" maxlength="30" size="30" placeholder="E-mail" required value="<?php if (isset($_GET["btn_form"])) {
                                                                                                                                                            echo $userEmail;
                                                                                                                                                          } ?>">
        </div>

        <div>
          <label for="user_password">Senha:</label>
          <input class="input_form_generic" type="password" id="user_password" name="user_password" maxlength="30" placeholder="Senha" size="30" required value="<?php if (isset($_GET["btn_form"])) {
                                                                                                                                                                    echo $userPassword;
                                                                                                                                                                  } ?>">
        </div>

        <div>
          <label for="user_access">Acesso:</label>
          <input class="input_form_generic" type="text" id="user_access" name="user_access" maxlength="1" size="1" pattern="[0-1]+$" placeholder="0 ou 1" required value="<?php if (isset($_GET["btn_form"])) {
                                                                                                                                                                            echo $userAccess;
                                                                                                                                                                          } ?>">
        </div>

        <input class="btn_generic" type="submit" name="btn_form" value="Cadastar">

        <a class="btn_generic" href="adminPage.php?num=<?php echo $_GET["num"]; ?>">Voltar</a>

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
<?php
require_once "../Database/TB_collaborators.php";
$c = new Collaborators("127.0.0.1", "root", "", "projeto_catarinoVeiculos");

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
  <link rel="stylesheet" href="./collaboratorConfiguration.css">
  <link rel="stylesheet" href="../reset.css">
  <title>Alterar Usuários</title>
</head>

<body>
  <header class="container_header">
    <?php
    include "../components/header/header.php";
    ?>
  </header>

  <section class="collaboratorConfiguration">
    <h1>Editar Usuários</h1>

    <form action="./collaboratorConfiguration.php" method="get">
      <table>
        <tr>
          <th>NOME</th>
          <th>E-MAIL</th>
          <th>SENHA</th>
          <th>A</th>
          <th></th>
        </tr>

        <?php
        $res = $c->selectDataAll();
        for ($i = 0; $i < count($res); $i++) {
          echo "<tr>";
          foreach ($res[$i] as $key => $value) {
            if ($key != "id") {
              echo "<td> {$value}</td>";
            }
          }
        ?>
          <td>
            <a href="collaboratorConfiguration.php?num=<?php echo $_GET["num"] ?>&id=<?php echo $res[$i]['id'] ?>"> <img src='../img/editar.png' alt='imagen de uma agenda'> </a>
          </td>
        <?php
          echo "</ tr>";
        }

        ?>
      </table>

      <?php
      if (isset($_GET["id"])) {
        $id_person = addslashes($_GET["id"]);
        $person = $c->selectDataRegisterById($id_person);
      }
      ?>

      <?php
      if (isset($_GET["btn_updata"])) {
        $userName = addslashes(ucfirst($_GET["username"]));
        $userEmail = addslashes(strtolower($_GET["user_email"]));
        $password = addslashes($_GET["password"]);
        $userAccess = addslashes($_GET["user_access"]);
        if ($userName) {
          $c->updataRegister(7, $userName, $userEmail, $password, $userAccess);
          echo "<p>Alteração realizada com sucesso.</p>";
        } else {
          echo "<p>Favor selecionar um colaborador.</p";
        }
      }
      ?>

      <input type="hidden" name="num" value="<?php echo $_GET['num']; ?>">
      <div>
        <label for="username">Nome:</label>
        <input class="input_form_generic" type="text" name="username" id="username" value="<?php if (isset($person)) {
                                                                                              echo $person["name"];
                                                                                            } else if (isset($_GET["btn_updata"])) {
                                                                                              echo $userName;
                                                                                            } ?>">
      </div>

      <div>
        <label for="user_email">E-mail:</label>
        <input class="input_form_generic" type="email" name="user_email" id="user_email" value="<?php if (isset($person)) {
                                                                                                  echo $person["email"];
                                                                                                } else if (isset($_GET["btn_updata"])) {
                                                                                                  echo $userEmail;
                                                                                                } ?>">
      </div>

      <div>
        <label for="password">Senha:</label>
        <input class="input_form_generic" type="text" name="password" id="password" value="<?php if (isset($person)) {
                                                                                              echo $person["password"];
                                                                                            } else if (isset($_GET["btn_updata"])) {
                                                                                              echo $password;
                                                                                            } ?>">
      </div>

      <div>
        <label for="user_access">Acesso:</label>
        <input class="input_form_generic" type="number" name="user_access" id="user_access" value="<?php if (isset($person)) {
                                                                                                      echo $person["access"];
                                                                                                    } else if (isset($_GET["btn_updata"])) {
                                                                                                      echo $userAccess;
                                                                                                    } ?>">
      </div>

      <input class="btn_generic" type="submit" value="Alterar" name="btn_updata">

      <a class="btn_generic" href="./adminPage.php?num=<?php echo $_GET["num"]; ?>">Voltar</a>

    </form>

  </section>




  <footer class="container_footer">
    <?php
    include "../components/footer/footer.html";
    ?>
  </footer>
</body>

</html>
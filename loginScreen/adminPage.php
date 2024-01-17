<?php
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
  <link rel="stylesheet" href="./AdminPage.css">
  <link rel="stylesheet" href="../components/footer/footer.css">
  <link rel="stylesheet" href="../reset.css">
  <title>Página da Administração</title>
</head>

<body>
  <header class="container_header">
    <?php
    include "../components/header/header.php";
    ?>
  </header>

  <main>
    <section class="container_login_screen">
      <p>Menu principal de gerenciamento </p>

      <nav class="menu_admin">
        <ul>
          <li class="menu_admin_li">
            <button>CARROS</button>
            <div>
              <a href="#" target="_self">novo</a>
              <a href="#" target="_self">editar</a>
              <a href="#" target="_self">exclir</a>
              <a href="./brandsAndModels.php?num=<?php echo $_GET["num"] ?>" target="_self">marcas /<br>
                modelos</a>
            </div>
          </li>

          <li class="menu_admin_li">
            <button>SLIDER</button>
            <div>
              <a href="#" target="_self">configurar</a>
            </div>
          </li>

          <?php
          if ($_SESSION['access'] == 1) {
          ?>

          <li class="menu_admin_li">
            <button>USUÁRIOS</button>
            <div>
              <a href="./newCollaborator.php?num=<?php echo $_GET["num"]; ?>" target="_self">novo</a>
              <a href="./collaboratorConfiguration.php?num=<?php echo $_GET["num"]; ?>" target="_self">editar</a>
              <a href="./deleteCollaborator.php?num=<?php echo $_GET["num"]; ?>" target="_self">excluir</a>
            </div>
          </li>

          <?php
          };
          ?>

          <li class="menu_admin_li">
            <button>LOGOFF</button>
            <div>
              <a href="#" target="_self">sair</a>
            </div>
          </li>

        </ul>
      </nav>
    </section>
  </main>

  <footer class="container_footer">
    <?php
    include "../components/footer/footer.html";
    ?>
  </footer>

  <script src="./adminPage.js"></script>
</body>

</html>
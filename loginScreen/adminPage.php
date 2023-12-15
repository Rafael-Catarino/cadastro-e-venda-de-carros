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
  <link rel="stylesheet" href="../components/menuAdminPage/menuAdminPage.css">
  <link rel="stylesheet" href="../components/footer/footer.css">
  <link rel="stylesheet" href="../reset.css">
  <title>Document</title>
</head>

<body>
  <header class="container_header">
    <?php
    include "../components/header/header.php";
    ?>
  </header>

  <main>
    <?php
    include "../components/menuAdminPage/menuAdminPage.php"
    ?>
  </main>

  <footer class="container_footer">
    <?php
    include "../components/footer/footer.html";
    ?>
  </footer>

  <script src="../components/menuAdminPage/script_menuAdminPage.js"></script>
</body>

</html>
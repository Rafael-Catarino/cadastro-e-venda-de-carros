<?php
include_once "../Database/TB_car.php";
$car = new Car('127.0.0.1', 'root', '', 'projeto_catarinoVeiculos');
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../reset.css">
  <link rel="stylesheet" href="../components/header/header.css">
  <link rel="stylesheet" href="../components/footer/footer.css">
  <title>Carros</title>
</head>

<body>
  <header class="container_header">
    <?php
    include "../components/header/header.php";
    ?>
  </header>

  <section>
    <?php
    echo "Carro";
    ?>
  </section>

  <footer class="container_footer">
    <?php
    include "../components/footer/footer.html";
    ?>
  </footer>

</body>

</html>
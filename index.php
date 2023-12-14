<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./components/header/header.css">
  <link rel="stylesheet" href="./components/slider/slider.css">
  <link rel="stylesheet" href="./components/search/search.css">
  <link rel="stylesheet" href="./components/footer/footer.css">
  <link rel="stylesheet" href="reset.css">
  <title>Catarino Veículos</title>
</head>

<body>
  <header class="container_header">
    <?php
    include "./components/header/header.php";
    ?>
  </header>
  <main>

    <section class="container_slider">
      <?php
      include "./components/slider/slider.php";
      ?>
    </section>

    <section class="container_search">
      <?php
      include "./components/search/search.php";
      ?>
    </section>

  </main>

  <footer class="container_footer">
    <?php
    include "./components/footer/footer.html";
    ?>
  </footer>

</body>

</html>
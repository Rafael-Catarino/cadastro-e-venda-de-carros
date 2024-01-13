<?php
include_once "../Database/TB_brands.php";
$tb = new TB_brands("127.0.0.1", 'root', '', 'projeto_catarinoVeiculos');
$tb->createTable();

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
  <link rel="stylesheet" href="./brandsAndModels.css">
  <link rel="stylesheet" href="../components/footer/footer.css">
  <link rel="stylesheet" href="../reset.css">
  <title>Marcas e Modelos</title>
</head>

<body>
  <header class="container_header">
    <?php
    include "../components/header/header.php";
    ?>
  </header>

  <section class="container_brandsAndModels">
    <h3>Marcas / Modelos</h3>

    <div>
      <button class="btn_generic">Adicionar</button>
      <button class="btn_generic">Deletar</button>
    </div>

    <?php
    if (isset($_GET["new_brand"])) {
      $brand = addslashes(strtoupper($_GET["brand"]));
      $res = $tb->selectDataInsert($brand);
      if ($res) {
        echo "<p>Marca já está cadastrada no banco de dados.</p>";
      } else {
        $tb->insertData($brand);
        echo "<p>Marca gravada com sucesso</p>";
      }
    }
    ?>

    <div class="conatainer_form">
      <form action="./brandsAndModels.php" method="get">
        <input type="hidden" name="num" value="<?php echo $_GET["num"]; ?>">
        <label for="brand">Nova marca:</label>
        <input class="input_form_generic" type="text" name="brand" maxlength="50" required id="brand">
        <input class="btn_generic" type="submit" value="Gravar marca" name="new_brand">
      </form>
      <form action="./brandsAndModels.php" method="get">
        <input type="hidden" name="num" value="<?php echo $_GET["num"]; ?>">
        <label for="model">Selecione uma marca:</label>
        <select name="model" id="model" required>
          <option value=""></option>
          <?php
          $arrRes = $tb->selectDataAll();
          if ($arrRes) {
            for ($i = 0; $i < count($arrRes); $i++) {
              echo "<option value='" . $arrRes[$i]["id_brand"] . "'>" . $arrRes[$i]["brand"] . "</option>";
            }
          } else if (isset($_GET["new_brand"])) {
            $arrRes = $tb->selectDataAll();
            for ($i = 0; $i < count($arrRes); $i++) {
              echo "<option value='" . $arrRes[$i]["id_brand"] . "'>" . $arrRes[$i]["brand"] . "</option>";
            }
          }
          ?>
        </select>
        <label for="model">Novo modelo:</label>
        <input class="input_form_generic" type="text" name="model" required id="model">
        <input class="btn_generic" type="submit" value="Gravar modelo" name="new_model">
      </form>
    </div>

    <a class="btn_generic" href="./adminPage.php?num=<?php echo $_GET["num"]; ?>">Voltar</a>
  </section>

  <footer class="container_footer">
    <?php
    include "../components/footer/footer.html"
    ?>
  </footer>

</body>

</html>
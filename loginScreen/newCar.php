<?php
require_once "../Database/TB_brands.php";
$tb_brand = new Brand("127.0.0.1", "root", "", "projeto_catarinoVeiculos");

require_once "../Database/TB_car.php";
$tb_car = new Car("127.0.0.1", "root", "", "projeto_catarinoVeiculos");

require_once "../Database/TB_models.php";
$tb_model = new Model("127.0.0.1", "root", "", "projeto_catarinoVeiculos");

session_start();
if (isset($_SESSION["numlogin"])) {
  if (isset($_GET["num"])) {
    $n1 = $_GET["num"];
  } else if (isset($_POST["num"])) {
    $n1 = $_POST["num"];
  }
  if ($_SESSION["numlogin"] != $n1) {
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
  <link rel="stylesheet" href="../reset.css">
  <link rel="stylesheet" href="../components/header/header.css">
  <link rel="stylesheet" href="../components/footer/footer.css">
  <link rel="stylesheet" href="newCar.css">
  <title>Novo Carro</title>
</head>

<body>
  <header class="container_header">
    <?php
    include "../components/header/header.php";
    ?>
  </header>

  <section class="container_newCar">

    <h2>Cadastre um novo carro.</h2>

    <?php
    if (isset($_POST["btn-form"])) {
      for ($i = 0; $i < 2; $i++) {
        if (isset($_FILES["photograph" . ($i + 1)]["name"])) {
          if ($_FILES["photograph" . ($i + 1)]["name"] != "") {
            $ex = strtolower(substr($_FILES["photograph" . ($i + 1)]["name"], -4));
            if ($ex == "jpeg") {
              $ex = ".jpeg";
            }
            $newName = uniqid() . $ex;
            move_uploaded_file($_FILES["photograph" . ($i + 1)]["tmp_name"], "../imgCar/" . $newName);
          }
        }
      }
    }
    ?>

    <form action="newCar.php" method="post" enctype="multipart/form-data">

      <input type="hidden" name="num" value="<?php echo $n1; ?>">
      <label for="brand">Marca:</label>
      <select name="brand" id="brand" class="input_form_generic">
        <option value=""></option>

        <?php
        $arrBrand = $tb_brand->selectDataAllBrand();
        if ($arrBrand) {
          for ($i = 0; $i < count($arrBrand); $i++) {
            echo "<option value='" . $arrBrand[$i]["id_brand"] . "'>" . $arrBrand[$i]["brand"] . "</option>";
          }
        }
        ?>
      </select>

      <label for="model">Modelo:</label>
      <select name="model" id="model" class="input_form_generic">
        <option value=""></option>
        <?php
        $arrModel = $tb_model->selectDataAllModel();
        if ($arrModel) {
          for ($i = 0; $i < count($arrModel); $i++) {
            echo "<option value='" . $arrModel[$i]["id_model"] . "' data-idbrand= '" . $arrModel[$i]["id_brand"] . "' >" . $arrModel[$i]["model"] . "</option>";
          }
        }
        ?>
      </select>

      <label for="id_version">Versão:</label>
      <input type="text" name="version" id="id_version" required class="input_form_generic">

      <label for="id_year_of_manufacture">Ano Fabricação:</label>
      <input type="text" name="year_of_manufacture" id="id_year_of_manufacture" pattern="[0-9]{4}" maxlength="4" size="4" required class="input_form_generic">

      <label for="id_model_year">Ano Modelo:</label>
      <input type="text" name="model_year" id="id_model_year" pattern="[0-9]{4}" maxlength="4" size="4" required class="input_form_generic">

      <label for="id_observation">Observação:</label>
      <textarea name="observation" id="id_observation" cols="51" rows="5" required class="input_form_generic"></textarea>

      <label for="id_value">Valor R$:</label>
      <input type="text" name="value" id="id_value" pattern="[0-9]+$" required class="input_form_generic">

      <div class="div_photograph">
        <label class="label_photograph btn_generic" for="photograph1">Foto 1</label>
        <input type="file" name="photograph1" id="photograph1" class="photograph">
        <label class="label_photograph btn_generic" for="photograph2">Foto 2</label>
        <input type="file" name="photograph2" id="photograph2" class="photograph">
      </div>

      <label for="">Opcionais:</label>
      <div>
        <input type="checkbox" name="opc1" id="id_label_opc1" value="1"><label for="id_label_opc1" class="label_opc">Ar
          Condicionado</label>
        <input type="checkbox" name="opc2" id="id_label_opc2" value="1"><label for="id_label_opc2" class="label_opc">Vidro Elétrico</label>
        <input type="checkbox" name="opc3" id="id_label_opc3" value="1"><label for="id_label_opc3" class="label_opc">Teto
          Solar</label>
      </div>

      <input name="btn-form" type="submit" value="Gravar" class="btn_generic">
      <a class="btn_generic" href="./adminPage.php?num=<?php echo $n1; ?>">Voltar</a>

    </form>
  </section>


  <footer class="container_footer">
    <?php
    include "../components/footer/footer.html";
    ?>
  </footer>

  <script src="newCar.js"></script>
</body>

</html>
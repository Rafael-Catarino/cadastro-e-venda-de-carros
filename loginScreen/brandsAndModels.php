<?php
include_once "../Database/TB_brands.php";
include_once "../Database/TB_models.php";
$tb_brands = new Brand('127.0.0.1', 'root', '', 'projeto_catarinoVeiculos');
$tb_models = new Model('127.0.0.1', 'root', '', 'projeto_catarinoVeiculos');

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

    <!-- Incuindo o cabaçalho da página -->
    <?php
    include "../components/header/header.php";
    ?>
    <!--  -->

  </header>


  <main>
    <section class="container_brandsAndModels">
      <h1>Marcas / Modelos</h1>
      <div>
        <button class="btn_generic btn_add">Adicionar</button>
        <button class="btn_generic btn_delete">Deletar</button>
      </div>
      <!-- Inserindo nova marca no banco de dados com PHP -->
      <?php
      if (isset($_GET["btn_new_brand"])) {
        $brand = addslashes(strtoupper($_GET["brand"]));
        $res = $tb_brands->selectDataInsertBrand($brand);
        if ($res) {
          echo "<p class='message'>Marca já cadastrada.</p>";
        } else {
          $tb_brands->insertDataBrand($brand);
          echo "<p class='message'>Marca salva com sucesso.</p>";
        }
      }
      ?>
      <!--  -->
      <!-- Inserindo novo modelo no banco de dados com PHP -->
      <?php
      if (isset($_GET["btn_new_model"])) {
        $model = addslashes(strtoupper($_GET["model"]));
        $id_brand = addslashes($_GET["id_brand"]);
        $res_model = $tb_models->selectDataInsertModel($model);
        if ($res_model) {
          echo "<p class='message'>Modelo já cadastrado.</p>";
        } else {
          $tb_models->insertDataModel($model, $id_brand);
          echo "<p class='message'>Modelo salvo com sucesso.</p>";
        }
      }
      ?>
      <!--  -->
      <div class="conatainer_form container_form_add">
        <form action="./brandsAndModels.php" method="get">
          <input type="hidden" name="num" value="<?php echo $_GET["num"]; ?>">
          <label for="brand">Nova marca:</label>
          <input class="input_form_generic" type="text" name="brand" maxlength="50" required id="brand">
          <input class="btn_generic" type="submit" value="Gravar marca" name="btn_new_brand">
        </form>
        <form action="./brandsAndModels.php" method="get">
          <input type="hidden" name="num" value="<?php echo $_GET["num"]; ?>">
          <label for="model">Selecione uma marca:</label>
          <select name="id_brand" id="model" required>
            <option value=""></option>
            <!-- Preenxendo o select com as marcas dinamicamente com o PHP -->
            <?php
            $arrBrand = $tb_brands->selectDataAllBrand();
            if ($arrBrand) {
              for ($i = 0; $i < count($arrBrand); $i++) {
                echo "<option value='" . $arrBrand[$i]["id_brand"] . "'>" . $arrBrand[$i]["brand"] . "</option>";
              }
            } else if (isset($_GET["new_brand"])) {
              $arrBrand = $tb_brands->selectDataAllBrand();
              for ($i = 0; $i < count($arrBrand); $i++) {
                echo "<option value='" . $arrBrand[$i]["id_brand"] . "'>" . $arrBrand[$i]["brand"] . "</option>";
              }
            }
            ?>
            <!--  -->
          </select>
          <label for="model">Novo modelo:</label>
          <input class="input_form_generic" type="text" name="model" required id="model">
          <input class="btn_generic" type="submit" value="Gravar modelo" name="btn_new_model">
        </form>
      </div>
      <!-- Deletando marca no banco de dados -->
      <?php
      if (isset($_GET["btn_delete_brand"])) {
        $id_brand = $_GET["id_brand"];
        if ($tb_models->selectDataDeleteBrand($id_brand)) {
          echo "<p class='message'>Não foi possível deletar a marca, <br> pôs tem modelo vinculado a essa marca.<br> Favor excluir todos os modelos relacionado a marca.</p>";
        } else {
          $tb_brands->deleteDataBrand($id_brand);
          echo "<p class='message'>Marca deletada com sucesso.</p>";
        }
      }
      ?>
      <!--  -->
      <?php
      if (isset($_GET["btn_delete_model"])) {
        $id_model = $_GET["id_model"];
        $tb_models->deleteDataModel($id_model);
        echo "<p class='message'>Modelo deletado com sucesso.</p>";
      }
      ?>
      <div class="conatainer_form container_form_delete">
        <form action="./brandsAndModels.php" method="get">
          <input type="hidden" name="num" value="<?php echo $_GET["num"]; ?>">
          <label for="model">Selecione uma marca:</label>
          <select name="id_brand" id="model" required>
            <option value=""></option>
            <!-- Preenxendo o select com as marcas dinamicamente com o PHP -->
            <?php
            $arrRes = $tb_brands->selectDataAllBrand();
            if ($arrRes) {
              for ($i = 0; $i < count($arrRes); $i++) {
                echo "<option value='" . $arrRes[$i]["id_brand"] . "'>" . $arrRes[$i]["brand"] . "</option>";
              }
            } else if (isset($_GET["new_brand"])) {
              $arrRes = $tb_brands->selectDataAllBrand();
              for ($i = 0; $i < count($arrRes); $i++) {
                echo "<option value='" . $arrRes[$i]["id_brand"] . "'>" . $arrRes[$i]["brand"] . "</option>";
              }
            }
            ?>
            <!--  -->
          </select>
          <input class="btn_generic" type="submit" value="Deletar marca" name="btn_delete_brand">
        </form>
        <form action="./brandsAndModels.php" method="get">
          <input type="hidden" name="num" value="<?php echo $_GET["num"]; ?>">
          <label for="model">Selecione um modelo:</label>
          <select name="id_model" id="model" required>
            <option value=""></option>
            <!-- Preenxendo o select com os modelos dinamicamente com o PHP -->
            <?php
            $arrModel = $tb_models->selectDataAllModel();
            $arrBrand = $tb_brands->selectDataAllBrand();
            if ($arrModel) {
              for ($j = 0; $j < count($arrBrand); $j++) {
                for ($i = 0; $i < count($arrModel); $i++) {
                  if ($arrBrand[$j]["id_brand"] === $arrModel[$i]["id_brand"]) {
                    echo "<option value='" . $arrModel[$i]["id_model"] . "'>" . $arrBrand[$j]["brand"] . " | " . $arrModel[$i]["model"] . "</option>";
                  }
                }
              }
            } else if (isset($_GET["delete_model"])) {
              for ($j = 0; $j < count($arrBrand); $j++) {
                for ($i = 0; $i < count($arrModel); $i++) {
                  if ($arrBrand[$j]["id_brand"] === $arrModel[$i]["id_brand"]) {
                    echo "<option value='" . $arrModel[$i]["id_model"] . "'>" . $arrBrand[$j]["brand"] . " | " . $arrModel[$i]["model"] . "</option>";
                  }
                }
              }
            }
            ?>
            <!--  -->
          </select>
          <input class="btn_generic" type="submit" value="Deletar modelo" name="btn_delete_model">
        </form>
      </div>
      <a class="btn_generic" href="./adminPage.php?num=<?php echo $_GET["num"]; ?>">Voltar</a>
    </section>
  </main>

  <footer class="container_footer">

    <!-- Incluindo o footer da pagina -->
    <?php
    include "../components/footer/footer.html"
    ?>
    <!--  -->

  </footer>

  <?php
  if (isset($_GET["btn_new_model"]) or isset($_GET["btn_new_brand"])) {
    echo "<script>document.querySelector('.container_form_add').style.display = 'block'; </script>";
  } else if (isset($_GET["btn_delete_model"]) or isset($_GET["btn_delete_brand"])) {
    echo "<script>document.querySelector('.container_form_delete').style.display = 'block'; </script>";
  }
  ?>

  <script src="brandsAndModels.js"></script>
</body>

</html>
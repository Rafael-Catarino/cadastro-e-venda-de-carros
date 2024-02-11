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

    <!-- submetendo um novo carro ao banco de dados -->
    <?php
    if (isset($_POST["btn-form"])) {

      //Faz o upload de uma imagem.
      $arrPhoto = array();
      $arrMini = array();

      $validatePhoto = 1;

      $dir = "../imgCar/";

      for ($i = 0; $i < 2; $i++) {

        // A função isset determina se uma variavel está declarada e é diferente de Vazio.
        if ($_FILES["photograph" . ($i + 1)]["name"] != "") {

          // A função strtolower() converte todos os caracteres alfabéticos ASCII em minúsculas.
          // A função substr() Retorna a parte de string especificada pelo parâmetro offset e length.
          $ex = strtolower(substr($_FILES["photograph" . ($i + 1)]["name"], -4));

          if ($ex == ".jpg" or $ex == "jpeg") {

            if ($ex == "jpeg") {
              $ex = ".jpeg";
            }

            // A função uniqid() obtém um identificador(nome) exclusivo prefixado com base na hora atual em microssegundos.
            $newName = uniqid() . $ex;

            // A função move_uploaded_file() verifica se o arquivo designado por from é um arquivo válido (o que significa que foi carregado através do mecanismo de upload HTTP POST do PHP).Se o arquivo for válido, ele será movido para o nome de arquivo fornecido por to.
            move_uploaded_file($_FILES["photograph" . ($i + 1)]["tmp_name"], $dir . $newName);

            // Criando as miniaturas das imagens.

            // A função list() atribui cada elemento de um array a uma variavel criada pela list().
            // A função getimagesize() retorna um array com as dimenções de uma imagem, seu tipo e uma string de texto de altura/largura a ser usada dentro de uma tag HTML IMG normal.
            list($width, $height, $type) = getimagesize($dir . $newName);

            // A função imagecreatefromjpeg() retorna um identificador de imagem que representa a imagem obtida de um determinado nome de arquivo.
            $image = imagecreatefromjpeg($dir . $newName);

            // A função imagecreatetruecolor() retorna um objeto de imagem representando uma imagem preta do tamanho especificado.
            $thumb = imagecreatetruecolor(117, 80);

            // A função imagecopyresampled() copia uma parte retangular de uma imagem para outra imagem, interpolando suavemente os valores dos pixels para que, em particular, a redução do tamanho de uma imagem ainda retenha uma grande clareza.
            imagecopyresampled($thumb, $image, 0, 0, 0, 0, 117, 80, $width, $height);

            // A função imagejpeg() cria um arquivo JPEG a partir do arquivoimage.
            imagejpeg($thumb, $dir . "mini_" . $newName);

            $arrPhoto[$i] = $dir . $newName;
            $arrMini[$i] = $dir . "mini_" . $newName;
          } else {
            $validatePhoto = 0;
          }
        } else {

          $arrPhoto[$i] = "";
          $arrMini[$i] = "";
        }
      }

      if ($validatePhoto == 1) {
        $idBrand = intval($_POST["brand"]);
        $idModel = intval($_POST["model"]);
        $version = addslashes($_POST["version"]);
        $yearOfManufacture = intval($_POST["year_of_manufacture"]);
        $modelYear = intval($_POST["model_year"]);
        $observation = addslashes($_POST["observation"]);
        $value = floatval($_POST["value"]);
        $photo1 = $arrPhoto[0];
        $photo2 = $arrPhoto[1];
        $mini1 = $arrMini[0];
        $mini2 = $arrMini[1];
        $opc1 = isset($_POST["opc1"]) ? 1 : 0;
        $opc2 = isset($_POST["opc2"]) ? 1 : 0;
        $opc3 = isset($_POST["opc3"]) ? 1 : 0;
        $sold = 0;
        $blocked = 0;

        $tb_car->insertCar($idBrand, $idModel, $version, $yearOfManufacture, $modelYear, $observation, $value, $photo1, $photo2, $mini1, $mini2, $opc1, $opc2, $opc3, $sold, $blocked);

        echo "<p class = 'message'>Carro cadastrado com sucesso.</p>";
      } else {
        echo "<p class = 'message'>Extenção de foto diferente de JPG ou JPEG,
        favor inserir uma foto valida.</p>";
      }
    }
    ?>

    <form action="newCar.php" method="post" enctype="multipart/form-data">

      <input type="hidden" name="num" value="<?php echo $n1; ?>">
      <label for="brand">Marca:</label>
      <select name="brand" id="brand" class="input_form_generic">
        <option value=""></option>

        <!-- Preenchendo os options dinamicamente com PHP  -->
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

        <!-- Preenchendo os options dinamicamente com PHP  -->
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
        <label class="label_photograph" for="photograph1">
          <span class="label_photograph1">Selecionar Foto 1: </span>
          <span>Procurar</span>
        </label>
        <input type="file" name="photograph1" id="photograph1" class="photograph">

        <label class="label_photograph" for="photograph2">
          <span class="label_photograph2">Selecionar Foto 2: </span>
          <span>Procurar</span>
        </label>
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
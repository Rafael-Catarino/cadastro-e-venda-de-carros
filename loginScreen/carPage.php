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
  <link rel="stylesheet" href="./carPage.css">
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
    $arrCar = $car->selectAllData();
    for ($i = 0; $i < count($arrCar); $i++) {
      echo
      "<div>
        Marca: " . $arrCar[$i]["id_brand"] . "<br>" .
        "Modelo: " . $arrCar[$i]["id_model"] . "<br>" .
        "Versão: " . $arrCar[$i]["version"] . "<br>" .
        "Ano Fabricação: " . $arrCar[$i]["yearOfManufacture"] . "<br>" .
        "Ano Mododelo: " . $arrCar[$i]["modelYear"] . "<br>" .
        "Observação: " . $arrCar[$i]["observation"] . "<br>" .
        "valor: R$" . number_format($arrCar[$i]["value"], 2, ',', '.') . "<br>" .
        "Foto1: <img src=" . $arrCar[$i]["photo1"] . ">" . "<br>" .
        "Foto2: <img src=" . $arrCar[$i]["photo2"] . ">" . "<br>" .
        "Mini1: <img src=" . $arrCar[$i]["miniature1"] . "> " . "<br>" .
        "Mini2: <img src=" . $arrCar[$i]["miniature2"] . "> " . "<br>" .
        "Opc1: " . $arrCar[$i]["optional1"] . "<br>" .
        "Opc2: " . $arrCar[$i]["optional2"] . "<br>" .
        "Opc3: " . $arrCar[$i]["optional3"] . "<br>" .
        "Vendido: " . $arrCar[$i]["sold"] . "<br>" .
        "Bloqueado: " . $arrCar[$i]["blocked"] . "<hr>
      </div>";
    }
    ?>
  </section>

  <footer class="container_footer">
    <?php
    include "../components/footer/footer.html";
    ?>
  </footer>

</body>

</html>
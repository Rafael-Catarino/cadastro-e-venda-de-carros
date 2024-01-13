<?php
require_once "../Database/Collaborators.php";
$c = new DataBaseCollaborators("127.0.0.1", "root", "", "projeto_catarinoVeiculos");

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
  <link rel="stylesheet" href="../../reset.css">
  <link rel="stylesheet" href="../genericForm.css">
  <link rel="stylesheet" href="./deleteCollaborator.css">
  <link rel="stylesheet" href="../../components/header/header.css">
  <link rel="stylesheet" href="../../components/footer/footer.css">
  <title>Deletar Funcionário</title>
</head>

<body>
  <header class="container_header">
    <?php
    include "../components/header/header.php";
    ?>
  </header>

  <main>
    <section class="conatinerTableDeleteCollaborator">
      <h1>Excluir Usuário</h1>
      <table>
        <tr>
          <th>ID</th>
          <th>NOME</th>
          <th>E-MAIL</th>
          <th>SENHA</th>
          <th>ACESSO</th>
        </tr>

        <?php
        if (isset($_GET["btn_form"])) {
          $id = $_GET["id"];
          $c->deleteDataRegister($id);
          echo "<p> Cadastro excluido </p>";
          $res = $c->selectDataAll();
          for ($i = 0; $i < count($res); $i++) {
            echo "<tr>";
            foreach ($res[$i] as $key => $value) {
              echo "<td> {$value}</td>";
            }
            echo "</ tr>";
          }
        } else {
          $res = $c->selectDataAll();
          for ($i = 0; $i < count($res); $i++) {
            echo "<tr>";
            foreach ($res[$i] as $key => $value) {
              echo "<td> {$value}</td>";
            }
            echo "</ tr>";
          }
        }
        ?>

      </table>
    </section>


    <section class="conatinerFormDeleteCollaborator">
      <form action="deleteCollaborator.php" method="get">
        <div>
          <input type="hidden" name="num" value="<?php echo $_GET["num"]; ?>">
          <label for="number_id">ID do usuário que vai ser excluido:</label>
          <input class="input_form_generic input_id" type="number" name="id" id="number_id">
        </div>

        <input name="btn_form" type="submit" value="Excluir" class="btn_generic">

        <a href="adminPage.php?num=<?php echo $_GET["num"]; ?>" class="btn_generic">Voltar</a>
      </form>
    </section>

  </main>

  <footer class="container_footer">
    <?php
    include "../components/footer/footer.html";
    ?>
  </footer>
</body>

</html>
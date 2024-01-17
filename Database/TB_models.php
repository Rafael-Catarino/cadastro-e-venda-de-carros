<?php
class Model
{
  private $connection;

  public function __construct($localhost, $user, $password, $dbname)
  {
    try {
      $this->connection = new PDO("mysql:host=" . $localhost . ";user=" . $user . ";password=" . $password . ";dbname=" . $dbname);
      $this->createTable();
    } catch (PDOException $e) {
      echo "A conexão falhou e retornou a mensagem de error: " . $e->getMessage();
    }
  }

  public function createTable()
  {
    $res = $this->connection->prepare(
      "CREATE TABLE IF NOT EXISTS tb_models ( id_model INT AUTO_INCREMENT,
      model VARCHAR(50),
      id_brand INT,
      PRIMARY KEY(id_model)
      );"
    );
    $res->execute();
  }

  public function insertDataModel(string $model, int $id_brand)
  {
    try {
      $res = $this->connection->prepare("INSERT INTO tb_models (model, id_brand) VALUE(:m, :b)");
      $res->bindValue(":m", $model);
      $res->bindValue(":b", $id_brand);
      $res->execute();
    } catch (PDOException $e) {
      echo "<p>Erro ao gravar o modelo.</p>" . $e->getMessage();
    }
  }

  public function selectDataInsertModel(string $model)
  {
    $res = $this->connection->prepare("SELECT * FROM tb_models WHERE model = :m");
    $res->bindValue(":m", $model);
    $res->execute();
    return $res->fetch(PDO::FETCH_ASSOC);
  }

  // Verifica se tem algum modelo atrelado a marca para saber se pode excluir o modelo.
  public function selectDataDeleteBrand(int $id_brand)
  {
    $res = $this->connection->prepare("SELECT * FROM tb_models WHERE id_brand = :id_brand");
    $res->bindValue(":id_brand", $id_brand);
    $res->execute();
    return $res->fetchAll(PDO::FETCH_ASSOC);
  }

  public function selectDataAllModel()
  {
    $res = $this->connection->prepare("SELECT * FROM tb_models");
    $res->execute();
    return $res->fetchAll(PDO::FETCH_ASSOC);
  }

  public function deleteDataModel(int $id_model)
  {
    $res = $this->connection->prepare("DELETE FROM tb_models WHERE id_model = :id_model");
    $res->bindValue(":id_model", $id_model);
    $res->execute();
  }
}

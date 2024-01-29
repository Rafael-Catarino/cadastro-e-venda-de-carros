<?php
class Brand
{
  private $connection;

  public function __construct($localhost, $user, $password, $dbname)
  {
    try {
      $this->connection = new PDO("mysql:host=" . $localhost . ";user=" . $user . ";password=" . $password . ";dbname=" . $dbname);
      $this->createTable();
    } catch (PDOException $e) {
      echo "A conexão falhou e retornou a mensagem de erro:" . $e->getMessage();
    }
  }

  public function createTable()
  {
    $res = $this->connection->prepare(
      "CREATE TABLE IF NOT EXISTS tb_brands (
        id_brand INT AUTO_INCREMENT,
        brand VARCHAR(50),
        PRIMARY KEY (id_brand)
      );"
    );
    $res->execute();
  }

  public function insertDataBrand(string $brand)
  {
    try {
      $res = $this->connection->prepare("INSERT INTO tb_brands (brand) value(:b)");
      $res->bindValue(":b", $brand);
      $res->execute();
    } catch (PDOException $e) {
      echo "<p>Erro ao gravar nova marca.</p>" . $e->getMessage();
    }
  }

  public function selectDataInsertBrand(string $brand)
  {
    $res = $this->connection->prepare("SELECT * FROM tb_brands WHERE brand = :b");
    $res->bindValue(":b", $brand);
    $res->execute();
    return $res->fetch(PDO::FETCH_ASSOC);
  }

  public function selectDataAllBrand()
  {
    $res = $this->connection->prepare("SELECT * FROM tb_brands ORDER BY brand");
    $res->execute();
    return $res->fetchAll(PDO::FETCH_ASSOC);
  }

  public function deleteDataBrand(int $id_brand)
  {
    $res = $this->connection->prepare("DELETE FROM tb_brands WHERE id_brand = :id_brand");
    $res->bindValue(":id_brand", $id_brand);
    $res->execute();
  }
}

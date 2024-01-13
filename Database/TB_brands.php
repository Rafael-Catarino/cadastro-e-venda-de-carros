<?php
class TB_brands
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

  public function insertData(string $brand)
  {
    try {
      $res = $this->connection->prepare("INSERT INTO tb_brands (brand) value(:b)");
      $res->bindValue(":b", $brand);
      $res->execute();
    } catch (PDOException $e) {
      echo "<p>Erro ao gravar novo funcionário.</p>" . $e->getMessage();
    }
  }

  public function selectDataInsert(string $brand)
  {
    $res = $this->connection->prepare("SELECT * FROM tb_brands WHERE brand = :b");
    $res->bindValue(":b", $brand);
    $res->execute();
    return $res->fetch(PDO::FETCH_ASSOC);
  }

  public function selectDataAll()
  {
    $res = $this->connection->prepare("SELECT * FROM tb_brands ORDER BY brand");
    $res->execute();
    return $res->fetchAll(PDO::FETCH_ASSOC);
  }
}

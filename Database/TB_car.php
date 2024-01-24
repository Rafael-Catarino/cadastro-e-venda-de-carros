<?php
class Car
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
      "CREATE TABLE IF NOT EXISTS tb_car (
      id_car INT AUTO_INCREMENT,
      id_brand INT,
      id_model INT,
      version VARCHAR(30),
      yearOfManufacture INT,
      modelYear INT,
      observation VARCHAR(300),
      value FLOAT,
      photo1 VARCHAR(50),
      photo2 VARCHAR(50),
      miniature1 VARCHAR(50),
      miniature2 VARCHAR(50),
      optional1 INT,
      optional2 INT,
      optional3 INT,
      sold INT,
      blocked INT,
      PRIMARY KEY (id_car)
      );"
    );
    $res->execute();
  }

  public function insertCar($id_brand, $id_model, $version, $yearOfManufacture, $modelYear, $observation, $value, $photo1, $photo2, $miniature1, $miniature2, $optional1, $optional2, $optional3, $sold, $blocked)
  {
    $res = $this->connection->prepare("INSERT INT tb_car(id_brand, id_model, version, yearOfManufacture, modelYear, observation, value, photo1, photo2, miniature1, miniature2, optional1, optional2, optional3, sold, blocked) VALUE (:id_brand, :id_model, :version, :yearOfManufacture, :modelYear, :observation, :value, :photo1, :photo2, :miniature1, :miniature2, :optional1, :optional2, :optional3, :sold, :blocked) ");
    $res->bindValue(":id_brand", $id_brand);
    $res->bindValue(":id_model", $id_model);
    $res->bindValue(":version", $version);
    $res->bindValue(":yearOfManufacture", $yearOfManufacture);
    $res->bindValue(":modelYear", $modelYear);
    $res->bindValue(":observation", $observation);
    $res->bindValue(":value", $value);
    $res->bindValue(":photo1", $photo1);
    $res->bindValue(":photo2", $photo2);
    $res->bindValue(":miniature1", $miniature1);
    $res->bindValue(":miniature2", $miniature2);
    $res->bindValue(":optional1", $optional1);
    $res->bindValue(":optional2", $optional2);
    $res->bindValue(":optional3", $optional3);
    $res->bindValue(":sold", $sold);
    $res->bindValue(":blocked", $blocked);
    $res->execute();
  }
}
<?php

class DataBaseCollaborators
{
  private $connection;

  public function __construct($localhost, $user, $password, $dbname)
  {
    try {
      $this->connection = new PDO("mysql:host=" . $localhost . ";user=" . $user . ";password=" . $password . ";dbname=" . $dbname);
      $this->createTable();
    } catch (PDOException $e) {
      echo "A conexão falhou e retornou a mensagem de erro: " . $e->getMessage();
    }
  }

  public function createTable()
  {
    $res = $this->connection->prepare(
      "CREATE TABLE IF NOT EXISTS employees(
        id INT NOT NULL AUTO_INCREMENT,
        name VARCHAR(30),
        email VARCHAR(30),
        password VARCHAR(15),
        access INT,
        PRIMARY KEY (id)
        )"
    );
    $res->execute();
  }

  public function insertData(string $name, string $email, string $password, string $access)
  {
    try {
      $res = $this->connection->prepare("INSERT INTO employees(name, email, password, access) VALUE(:n, :e, :p, :a)");
      $res->bindValue(":n", $name);
      $res->bindValue(":e", $email);
      $res->bindValue(":p", $password);
      $res->bindValue(":a", $access);
      $res->execute();
    } catch (PDOException $e) {
      echo "<p>Erro ao gravar novo funcionário.</p>" . $e->getMessage();
    }
  }

  public function selectDataLogin(string $email, string $password)
  {
    $res = $this->connection->prepare("SELECT * FROM employees WHERE email = :email AND password = :password");
    $res->bindValue(":email", $email);
    $res->bindValue(":password", $password);
    $res->execute();
    return $res->fetch(PDO::FETCH_ASSOC);
  }

  public function selectDataRegister(string $name, string $email, string $password, string $access)
  {
    $res = $this->connection->prepare("SELECT * FROM employees WHERE name = :name AND email = :email AND password = :password AND access = :access");
    $res->bindValue(":name", $name);
    $res->bindValue(":email", $email);
    $res->bindValue(":password", $password);
    $res->bindValue(":access", $access);
    $res->execute();
    return $res->fetch(PDO::FETCH_ASSOC);
  }

  public function selectDataAll()
  {
    $res = $this->connection->prepare("SELECT * FROM employees");
    $res->execute();
    return $res->fetchAll(PDO::FETCH_ASSOC);
  }

  public function deleteDataRegister(string $id)
  {
    $res = $this->connection->prepare("DELETE FROM employees WHERE id = :id");
    $res->bindValue(":id", $id);
    $res->execute();
  }
}

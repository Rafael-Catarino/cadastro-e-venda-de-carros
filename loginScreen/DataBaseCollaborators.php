<?php

class DataBaseCollaborators
{
  private $connection;

  public function __construct($localhost, $user, $password, $dbname)
  {
    try {
      $this->connection = new PDO("mysql:host=" . $localhost . ";user=" . $user . ";password=" . $password . ";dbname=" . $dbname);
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

  public function insertData(string $name, string $email, string $password)
  {
    $res = $this->connection->prepare("INSERT INTO employees(name, email, password) VALUE(:n, :e, :p");
    $res->bindValue(":n", $name);
    $res->bindValue(":e", $email);
    $res->bindValue(":p", $password);
    $res->execute();
  }

  public function selectOneData(string $email, string $password)
  {
    $res = $this->connection->prepare("SELECT * FROM employees WHERE email = :email AND password = :password");
    $res->bindValue(":email", $email);
    $res->bindValue(":password", $password);
    $res->execute();
    return $res->fetch(PDO::FETCH_ASSOC);
  }
}

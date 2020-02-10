<?php

class Database
{
    private static $connection;
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "defaultDB";

    private function __construct()
    {
        try {
            self::$connection  = new \PDO("mysql:host=$this->host;dbname=$this->database", $this->username, $this->password);
            echo 'Установлено соединение с БД';
        } catch (PDOException $e) {
            die('Подключение не удалось: ' . $e->getMessage());
        }
    }

    public static function connect()
    {
        if (!self::$connection) {
            self::$connection = new self();
        }
        return self::$connection;
    }

    public static function query(string $sql)
    {
        $newQuery = self::$connection->query($sql);
        while ($row = $newQuery->fetch())
        {
            echo $row . "\n";
        }
    }

    public static function create($data1, $data2, $data3)
    {
        $sql = "INSERT INTO demo_table (column1, column2, column3) VALUES (?,?,?)";
        $query= self::$connection->prepare($sql);
        $query->execute([$data1, $data2, $data3]);
    }

    public function read($id)
    {
        $sql = self::$connection->prepare("SELECT * FROM demo_tables WHERE id=?");
        $sql->execute([$id]);
        $data = $sql->fetch();
    }

    public function update($data1, $data2, $data3, $id)
    {
        $sql = "UPDATE demo_table SET column1=?, column2=?, column3=? WHERE id=?";
        self::$connection->prepare($sql)->execute([$data1, $data2, $data3, $id]);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM demo_table WHERE id=?";
        self::$connection->prepare($sql)->execute([$id]);
    }
}

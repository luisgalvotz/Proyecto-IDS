<?php

class BaseDeDatos
{
    private $host = "localhost";
    private $dbName = "bd_welearn";
    private $username = "root";
    private $password = "";

    private $connection;

    public function connect()
    {
        $this->connection = null;

        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbName;

        $this->connection = new PDO($dsn, $this->username, $this->password);

        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        return $this->connection;
    }
}

?>


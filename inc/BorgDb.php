<?php

class BorgDb
{
    static public function dbMySql()
    {
        $host     = getenv('MYSQL_HOST_1');
        $user     = 'root';
        $password = getenv('MYSQL_ROOT_PASSWORD');
        $database = 'information_schema';
        $port     = '3306';
        $charset  = getenv('MYSQL_INITDB_CHARSET');
        $dsn      = "mysql:host=$host:$port;dbname=$database;charset=$charset";
        $pdo      = new PDO($dsn, $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

    static public function dbPostgre()
    {
        $host     = 'postgresql';
        $user     = getenv('POSTGRES_USER');
        $password = getenv('POSTGRES_PASSWORD');
        $database = getenv('POSTGRES_DB');
        $port     = '5432';
        $conn     = pg_connect("host=$host port=$port dbname=$database user=$user password=$password");
        return $conn;
    }


    static public function checkAll()
    {
        return [
            'mysql'   => (bool)static::dbMySql(),
            'postgre' => (bool)static::dbPostgre(),
        ];
    }
}
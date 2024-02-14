<?php

namespace App\Libraries;

use \PDO;

class MySQL
{
    private $connection;

    public function __construct()
    {
        $dsn = 'mysql:host=mysql;dbname=userapi_php';
        $this->connection = new PDO($dsn, 'userapi', 'password');
    }

    public function select($query)
    {
        $sql = 'SELECT * FROM '.$query;

        $stmt = $this->connection->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    public function insert($model, $table)
    {
        $attributes = get_object_vars($model);
        $columns = implode(', ', array_keys($attributes));
        $values = implode(', ', array_fill(0, count($attributes), '?'));

        $sql = 'INSERT INTO '.$table.' ('.$columns.') VALUES ('.$values.') ';
        $stmt = $this->connection->prepare($sql);

        $bind = 1;
        foreach($attributes as $value)
        {
            $stmt->bindValue($bind, $value);
            $bind ++;
        }

        $stmt->execute();
    }

    public function update($table, $where, $attributes)
    {
        $columns = implode('=?, ', array_keys($attributes)).'=?';
        $sql = 'UPDATE '.$table.' SET '.$columns.' WHERE TRUE AND '.$where;
        
        $stmt = $this->connection->prepare($sql);
        
        $stmt->execute(array_values($attributes));
    }

    public function delete($table, $where)
    {
        $sql = 'DELETE FROM '.$table.' WHERE TRUE AND '.$where;

        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
    }

}
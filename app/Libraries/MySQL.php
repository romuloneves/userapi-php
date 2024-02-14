<?php

namespace App\Libraries;

use \PDO;

/**
 * Classe MySQL: Classe responsável por manipular o PHP PDO e credenciais de acesso ao MySQL.
 * Também armazena métodos de apoio para a manipulação do banco de dados.
 */

class MySQL
{
    private $connection;


    /**
     * Construtor responsável por carregar as credenciais de banco de dados na DSN do PDO.
     */

    public function __construct()
    {
        $config = parse_ini_file('config.ini', true);

        $hostname = $config['mysql']['hostname'];
        $database = $config['mysql']['database'];
        $username = $config['mysql']['username'];
        $password = $config['mysql']['password'];

        $dsn = 'mysql:host='.$hostname.';dbname='.$database;
        $this->connection = new PDO($dsn, $username, $password);
    }


    /**
     * Método select(): Responsável por manipular consultas através do PDO.
     */

    public function select($query)
    {
        $sql = 'SELECT * FROM '.$query;

        $stmt = $this->connection->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }


    /**
     * Método select(): Responsável por inserir registros através do PDO.
     * Gera o INSERT se baseando na estrutura da classe recebida no parâmetro $model.
     */

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


    /**
     * Método update(): Responsável por atualizar registros através do PDO.
     * Gera os atributos do UPDATE através da variável $attributes e da variável $where como clausula WHERE.
     */

    public function update($table, $where, $attributes)
    {
        $columns = implode('=?, ', array_keys($attributes)).'=?';
        $sql = 'UPDATE '.$table.' SET '.$columns.' WHERE TRUE AND '.$where;
        
        $stmt = $this->connection->prepare($sql);
        
        $stmt->execute(array_values($attributes));
    }

    /**
     * Método delete(): Responsável por remover registros através do PDO.
     * Gera o DELETE através da variável $where como clausula WHERE.
     */

    public function delete($table, $where)
    {
        $sql = 'DELETE FROM '.$table.' WHERE TRUE AND '.$where;

        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
    }

}
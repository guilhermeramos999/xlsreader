<?php

namespace Project\Pdo\Infraestructure;

use Exception;
use PDO;

class Conn
{
    private $dsn = 'mysql:localhost;dbname:escola';
    private $user = 'root';
    private $pass = 'Guilherme10@';

    public function startConnection()
    {
        try{
            $this->connection = new PDO($this->dsn,$this->user,$this->pass);
            $this->createTable();
        } catch(Exception $e){
            echo $e->getMessage();
        }
    }

    public function createTable()
    {
        $createStmt = "
            CREATE TABLE IF NOT EXISTS escola.alunos (
                id int not null auto_increment,
                nome varchar(255),
                curso varchar(255),
                PRIMARY KEY (id)
            )";
        try{
            $this->connection->exec($createStmt);
        } catch(Exception $err){
            echo $err->getMessage();
        }
        
    }
}

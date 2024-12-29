<?php
namespace database;
use PDO;
use PDOException;
class DataBase
{
    protected $host = HOST;
    protected $db_name = DB_NAME;
    protected $user = USER;
    protected $pass = PASS;

    protected $conn;

    public function __construct()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->db_name", $this->user, $this->pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        return  $this->conn;
    }
}
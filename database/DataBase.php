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
            echo "Connected successfully";
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        return $this->conn;
    }

    // Select Data In Database
    public function Select($query, $value = null)
    {
        try {
            // Prepare the SQL statement
            $result = $this->conn->prepare($query);

            // Execute the query with or without the value parameter
            if ($value === null) {
                $result->execute();
            } else {
                // If $value is an array, you can use it directly
                $result->execute((array)$value);
            }

            // Fetch all the results as an associative array
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Handle error and display message
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }

}


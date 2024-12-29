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
            echo 'Error: ' . $e->getMessage();
        }

        return $this->conn;
    }

    // Select Data In Database
    public function Select($query, $values = null)
    {
        try {
            // Prepare the SQL statement
            $result = $this->conn->prepare($query);

            // Execute the query with or without the value parameter
            if ($values === null) {
                $result->execute();
            } else {
                // If $value is an array, you can use it directly
                $result->execute((array)$values);
            }

            // Fetch all the results as an associative array
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Handle error and display message
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }

    // Insert Data Into Database
    public function Insert($table, $fields, $data)
    {
        try {
            // Sanitize table name and field names to avoid SQL injection
            $table = preg_replace('/[^a-zA-Z0-9_]/', '', $table); // Allow only alphanumeric characters and underscores
            $fields = array_map(function ($field) {
                return preg_replace('/[^a-zA-Z0-9_]/', '', $field); // Sanitize field names
            }, $fields);

            // Prepare the SQL statement with named placeholders
            $statement = $this->conn->prepare("INSERT INTO" . $table . "(" . implode(', ', $fields) . " ,created_at) VALUES ( :" . implode(', :', $fields) . ", now() );");

            // Bind the data with field names and execute
            $statement->execute(array_combine($fields, $data));

            // Return the last inserted ID
            return $this->conn->lastInsertId();

        } catch (PDOException $e) {
            // Handle error
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }



}


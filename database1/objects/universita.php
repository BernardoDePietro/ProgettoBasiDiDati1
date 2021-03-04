<?php

class Universita {
    private $conn;
    private $table_name = "universita";

    //Proprietà dell'oggetto
    public $id;
    public $nome;
    public $citta;

    public function __construct($db) {
        $this->conn = $db;
    }

    function read() {
        //select all query
        $query = "SELECT * FROM " . $this->table_name;

        //prepare query statement
        $stmt = $this->conn->prepare($query);

        //execute query
        $stmt->execute();

        return $stmt;
    }
}

?>
<?php

class Resource
{
    private $conn;

    private $db_table = "Resource";

    // Columns
    public $id;
    public $resource_name;
    public $balance_available;

    // Db connection
    public function __construct($db){
        $this->conn = $db;
    }

    // GET ALL
    public function getResources(){
        $sqlQuery = "SELECT id, resource_name, balance_available FROM " . $this->db_table ;
        $allResources = $this->conn->prepare($sqlQuery);
        $allResources->execute();
        return $allResources;
    }

    // CREATE
    public function createResource(){
        $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        resource_name = :resource_name, 
                        balance_available = :balance_available";

        $insertResource = $this->conn->prepare($sqlQuery);

        // sanitize
        $this->resource_name=htmlspecialchars(strip_tags($this->resource_name));
        $this->balance_available=htmlspecialchars(strip_tags($this->balance_available));

        // bind data
        $insertResource->bindParam(":club_name", $this->resource_name);
        $insertResource->bindParam(":balance_available", $this->balance_available);

        if($insertResource->execute()){
            return true;
        }
        return false;
    }

}
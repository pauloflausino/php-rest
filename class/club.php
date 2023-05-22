<?php

class Club
{
    private $conn;

    // Table
    private $db_table = "Club";

    // Columns
    public $id;
    public $club_name;
    public $balance_available;

    // Db connection
    public function __construct($db){
        $this->conn = $db;
    }

    // GET ALL
    public function getClubes(){
        $sqlQuery = "SELECT id, club_name, balance_available FROM " . $this->db_table ;
        $allClubes = $this->conn->prepare($sqlQuery);
        $allClubes->execute();
        return $allClubes;
    }

    // CREATE
    public function createClub(){
        $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        club_name = :club_name, 
                        balance_available = :balance_available";

        $insertClub = $this->conn->prepare($sqlQuery);

        // sanitize
        $this->club_name=htmlspecialchars(strip_tags($this->club_name));
        $this->balance_available=htmlspecialchars(strip_tags($this->balance_available));

        // bind data
        $insertClub->bindParam(":club_name", $this->club_name);
        $insertClub->bindParam(":balance_available", $this->balance_available);

        if($insertClub->execute()){
            return true;
        }
        return false;
    }

    public function getClub($id){
        $sqlQuery = "SELECT
                        id,
                        club_name,
                        balance_available
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       id = ?
                    LIMIT 0,1";

        $stmt = $this->conn->prepare($sqlQuery);

        $stmt->bindParam(1, $id);

        $stmt->execute();

        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->balance_available = $dataRow['balance_available'];

        return $dataRow;
    }

    // UPDATE
    public function getSingleClub(){
        $sqlQuery = "SELECT
                        id, 
                        club_name, 
                        balance_available
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       id = ?
                    LIMIT 0,1";

        $stmt = $this->conn->prepare($sqlQuery);

        $stmt->bindParam(1, $this->id);

        $stmt->execute();

        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->club_name = $dataRow['club_name'];
        $this->balance_available = $dataRow['balance_available'];
    }

    // UPDATE
    public function updateClub(){
        $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        club_name = :club_name, 
                        balance_available = :balance_available
                    WHERE 
                        id = :id";

        $stmt = $this->conn->prepare($sqlQuery);

        $this->club_name=htmlspecialchars(strip_tags($this->club_name));
        $this->balance_available=htmlspecialchars(strip_tags($this->balance_available));
        $this->id=htmlspecialchars(strip_tags($this->id));

        // bind data
        $stmt->bindParam(":club_name", $this->club_name);
        $stmt->bindParam(":balance_available", $this->balance_available);
        $stmt->bindParam(":id", $this->id);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    // UPDATE
    public function updateClubById($id, $newBalance){
        $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        club_name = :club_name, 
                        balance_available = :balance_available
                    WHERE 
                        id = :id";

        $stmt = $this->conn->prepare($sqlQuery);

        $this->balance_available=htmlspecialchars(strip_tags($newBalance));

        // bind data
        $stmt->bindParam(":club_name", $this->club_name);
        $stmt->bindParam(":balance_available", $newBalance);
        $stmt->bindParam(":id", $id);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

}
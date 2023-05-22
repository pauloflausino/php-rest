<?php

include_once 'club.php';

class consume
{
    private $conn;

    // Table
    private $db_table = "consume";

    // Columns
    public $id;
    public $club_id;
    public $resource_id;
    public $cost;

    // Db connection
    public function __construct($db){
        $this->conn = $db;
    }

    // CREATE
    public function createConsume(){

        $club = new Club($this->conn);
        $clubData = $club->getClub($this->club_id);

        if($clubData['balance_available'] >= $this->cost){

            $newBalanceAvailable = $clubData['balance_available'] - $this->cost;
            $item = $club;
            $item->id = $this->club_id;
            $item->getSingleClub();

            if($item->club_name != null){
                // create array
                $clubArr = array(
                    "clube" => $item->club_name,
                    "saldo_anterior" => $item->balance_available,
                    "saldo_atual" => $item->balance_available - $this->cost
                );
            }
            $allClub = $club->getClubes();
            $item->balance_available = $newBalanceAvailable;

            if($item->updateClub()){

                $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        club_id = :club_id, 
                        resource_id = :resource_id, 
                        cost = :cost";

                $insertConsume = $this->conn->prepare($sqlQuery);

                // sanitize
                $this->club_id=htmlspecialchars(strip_tags($this->club_id));
                $this->resource_id=htmlspecialchars(strip_tags($this->resource_id));
                $this->cost=htmlspecialchars(strip_tags($this->cost));

                // bind data
                $insertConsume->bindParam(":club_id", $this->club_id);
                $insertConsume->bindParam(":resource_id", $this->resource_id);
                $insertConsume->bindParam(":cost", $this->cost);

                if($insertConsume->execute()){
                    http_response_code(200);
                    echo json_encode($clubArr);
                    return true;
                }
                return false;

            } else{
                return false;
            }
        }else {
            http_response_code(400);
            echo "O saldo disponivel do clube e insuficiente.";

            return false;
        }
    }
}
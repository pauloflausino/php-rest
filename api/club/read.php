<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../class/club.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new Club($db);

    $clubes = $items->getClubes();
    $itemCount = $clubes->rowCount();

    if($itemCount > 0){
        
        $clubArr = array();

        while ($row = $clubes->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id" => $id,
                "clube" => $club_name,
                "saldo_disponivel" => number_format($balance_available,2,",",".")
            );
            array_push($clubArr, $e);
        }
        echo json_encode($clubArr);
    }else{
        http_response_code(400);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>
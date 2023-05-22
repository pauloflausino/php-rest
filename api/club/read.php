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


    echo json_encode($itemCount);

    if($itemCount > 0){
        
        $clubArr = array();

        while ($row = $clubes->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id" => $id,
                "clube" => $club_name,
                "saldo_disponivel" => $balance_available
            );

            array_push($clubArr, $e);
        }
        echo json_encode($clubArr);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>
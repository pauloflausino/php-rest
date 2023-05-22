<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../class/resource.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new Resource($db);

    $resources = $items->getResources();
    $itemCount = $resources->rowCount();

    if($itemCount > 0){
        
        $resouceArr = array();

        while ($row = $resources->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id" => $id,
                "recurso" => $resource_name,
                "saldo_disponivel" => number_format($balance_available,2,",",".")
            );

            array_push($resouceArr, $e);
        }
        echo json_encode($resouceArr);
    } else{
        http_response_code(400);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>
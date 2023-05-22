<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/resource.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Resource($db);

    if(empty($_POST["recurso"])){
        http_response_code(400);
        echo 'Necessario informar Recurso';
        return false;
    }
    if(empty($_POST["saldo_disponivel"])){
        http_response_code(400);
        echo 'Necessario informar saldo_disponivel.';
        return false;
    }

    $item->resource_name = $_POST["recurso"];
    $item->balance_available = $_POST["saldo_disponivel"];

    if($item->createResource()){
        echo 'Resource created successfully.';
    } else{
        echo 'Resource could not be created.';
    }
?>
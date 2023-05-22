<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/consume.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Consume($db);

    if(empty($_POST["recurso_id"])){
        http_response_code(400);
        echo 'Necessario informar recurso_id';
        return false;
    }
    if(empty($_POST["clube_id"])){
        http_response_code(400);
        echo 'Necessario informar clube_id.';
        return false;
    }
    if(empty($_POST["valor_consumo"])){
        http_response_code(400);
        echo 'Necessario informar valor do consumo.';
        return false;
    }

    $item->club_id = $_POST["clube_id"];
    $item->resource_id = $_POST["recurso_id"];
    $item->cost = $_POST["valor_consumo"];

    $item->createConsume();

?>
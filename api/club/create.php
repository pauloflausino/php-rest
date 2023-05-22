<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/club.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Club($db);

    $item->club_name = $_POST["clube"];
    $item->balance_available = $_POST["saldo_disponivel"];

    if($item->createClub()){
        http_response_code(200);
        echo 'OK';
    } else{
        http_response_code(404);
        echo 'Not OK.';
    }
?>
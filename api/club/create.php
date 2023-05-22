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

    $item->club_name = $_POST["club_name"];
    $item->balance_available = $_POST["balance_available"];

    if($item->createClub()){
        echo 'Club created successfully.';
    } else{
        echo 'Club could not be created.';
    }
?>
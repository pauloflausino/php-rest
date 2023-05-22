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

    $item->resource_name = $_POST["resource_name"];
    $item->balance_available = $_POST["balance_available"];

    if($item->createResource()){
        echo 'Resource created successfully.';
    } else{
        echo 'Resource could not be created.';
    }
?>
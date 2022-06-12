<?php

require 'database.php';

$sql = $con->prepare("SELECT * FROM serie");
$sql->execute();


if ($sql->rowCount()) {

    $serie = $sql->fetchAll(PDO::FETCH_ASSOC);

    http_response_code(201);

    echo json_encode($serie);
    
} 
else {
    http_response_code(404);
}
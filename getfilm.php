<?php

require 'database.php';

$sql = $con->prepare("SELECT * FROM film");
$sql->execute();


if ($sql->rowCount()) {

    $film = $sql->fetchAll(PDO::FETCH_ASSOC);

    http_response_code(201);

    echo json_encode($film);
    
} 
else {
    http_response_code(404);
}
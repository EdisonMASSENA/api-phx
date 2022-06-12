<?php
require 'database.php';

// Get the posted data.
// $postdata = file_get_contents("php://input");

// $request = json_decode($postdata);

// $id = $request->id;

$id = $_GET['id'];


$verify = $con->prepare("SELECT * FROM film WHERE id = :id");
$verify->bindValue(':id', $id, PDO::PARAM_STR);
$verify->execute();


if ($verify->rowCount()) {
    $delete = $con->prepare("DELETE FROM film WHERE id = :id");

    $delete->bindValue(':id', $id, PDO::PARAM_STR);

    $delete->execute();

    http_response_code(201);
    $success = true;

    echo json_encode($success);

}

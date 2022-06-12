<?php
require 'database.php';

// Get the posted data.
$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
  // Extract the data.
    $request = json_decode($postdata);


    $nom = $request->nom;
    $duree = $request->duree;
    $genre = $request->genre;
    $acteur = $request->acteur;
    $realisateur = $request->realisateur;
    $date = $request->date;
    $note = $request->note;
    $description = $request->description;


    $data = $con->prepare("SELECT * FROM serie WHERE nom = :nom");
    $data->bindValue(':nom', $nom, PDO::PARAM_STR);
    $data->execute();

    if($data->rowCount())
    {
        $errorEmail = 'Serie inexistant.';
        $error = true;
        http_response_code(422);
        echo json_encode($errorEmail);
    }

    if(!isset($error))
    {
        $insert = $con->prepare("INSERT INTO serie (nom, duree, genre, acteur, realisateur, date, note, description) VALUES (:nom, :duree, :genre, :acteur, :realisateur, :date, :note, :description)");

        $insert->bindValue(':nom', $nom, PDO::PARAM_STR); 
        $insert->bindValue(':duree', $duree, PDO::PARAM_STR); 
        $insert->bindValue(':genre', $genre, PDO::PARAM_STR);
        $insert->bindValue(':acteur', $acteur, PDO::PARAM_STR); 
        $insert->bindValue(':realisateur', $realisateur, PDO::PARAM_STR); 
        $insert->bindValue(':date', $date, PDO::PARAM_STR); 
        $insert->bindValue(':note', $note, PDO::PARAM_STR); 
        $insert->bindValue(':description', $description, PDO::PARAM_STR);

        $insert->execute();
        
        http_response_code(201);
        $success = true;

        echo json_encode($success);

    }

}
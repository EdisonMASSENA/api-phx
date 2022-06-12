<?php
require 'database.php';

// Get the posted data.
$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
  // Extract the data.
    $request = json_decode($postdata);

    $id = $request->id;
    $nom = $request->nom;
    $duree = $request->duree;
    $genre = $request->genre;
    $acteur = $request->acteur;
    $realisateur = $request->realisateur;
    $date = $request->date;
    $note = $request->note;
    $description = $request->description;


    $verify = $con->prepare("SELECT * FROM serie WHERE id = :id");
    $verify->bindValue(':id', $id, PDO::PARAM_STR);
    $verify->execute();



    if($verify->rowCount())
    {
        $update = $con->prepare("UPDATE serie SET nom = :nom, duree = :duree, genre = :genre, acteur = :acteur, realisateur = :realisateur, date = :date, note = :note, description = :description WHERE id = :id");

        $update->bindValue(':id', $id, PDO::PARAM_STR); 
        $update->bindValue(':nom', $nom, PDO::PARAM_STR); 
        $update->bindValue(':duree', $duree, PDO::PARAM_STR); 
        $update->bindValue(':genre', $genre, PDO::PARAM_STR);
        $update->bindValue(':acteur', $acteur, PDO::PARAM_STR); 
        $update->bindValue(':realisateur', $realisateur, PDO::PARAM_STR); 
        $update->bindValue(':date', $date, PDO::PARAM_STR); 
        $update->bindValue(':note', $note, PDO::PARAM_STR); 
        $update->bindValue(':description', $description, PDO::PARAM_STR); 

        $update->execute();
        
        http_response_code(201);
        $success = true;

        echo json_encode($success);

    } else
    {
        $errorEmail = 'Serie inexistant.';
        $error = true;
        http_response_code(422);
        echo json_encode($errorEmail);
    }

}
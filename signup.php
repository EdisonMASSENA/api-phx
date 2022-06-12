<?php
require 'database.php';

// Get the posted data.
$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
  // Extract the data.
    $request = json_decode($postdata);


    $pseudo = $request->pseudo;
    $email = $request->email;
    $mdp = $request->mdp;
    $preference = implode(',', $request->preference);
    $inscrit = $request->inscrit;


    $data = $con->prepare("SELECT * FROM user WHERE email = :email");
    $data->bindValue(':email', $email, PDO::PARAM_STR);
    $data->execute();

    if($data->rowCount())
    {
        $errorEmail = 'Compte existant à cette adresse mail.';
        $error = true;
        http_response_code(422);
        echo json_encode($errorEmail);
    }

    if(!isset($error))
    {
        $mdph = password_hash($mdp, PASSWORD_DEFAULT);

        $insert = $con->prepare("INSERT INTO user (pseudo, email, mdp, preference, inscription) VALUES (:pseudo, :email, :mdp, :preference, :inscription)");

        $insert->bindValue(':pseudo', $pseudo, PDO::PARAM_STR); 
        $insert->bindValue(':email', $email, PDO::PARAM_STR); 
        $insert->bindValue(':mdp', $mdph, PDO::PARAM_STR);
        $insert->bindValue(':preference', $preference, PDO::PARAM_STR); 
        $insert->bindValue(':inscription', $inscrit, PDO::PARAM_STR); 

        $insert->execute();
        
        http_response_code(201);
        $success = true;

        echo json_encode($success);

    }


 // echo $request;

  // Validate.
  // if(trim($request->number) === '' || (float)$request->amount < 0)
  // {
  //   return http_response_code(400);
  // }

  // Sanitize.
  // $pseudo = mysqli_real_escape_string($con, trim($request->pseudo));
  // $email = mysqli_real_escape_string($con, trim($request->email));
  // $mdp = mysqli_real_escape_string($con, trim($request->mdp));
  // $mdph = password_hash($mdp, PASSWORD_DEFAULT);
  // $preference = mysqli_real_escape_string($con, implode(",",$request->preference));
  // $inscrit = $request->inscrit;
  


  // Create.
  // $sql = "INSERT INTO user(pseudo,email,mdp, preference, inscription) VALUES ('{$pseudo}' ,'{$email}','{$mdph}', '{$preference}', '{$inscrit}')";

  // if(mysqli_query($con,$sql))
  // {
  //   http_response_code(201);
  //   $user = [
  //     'pseudo' => $pseudo,
  //     'email' => $email,
  //     'mdp' => $mdp,
  //     'preference' => $preference,
  //     'inscrit' => $inscrit,
      
  //     // 'id'    => mysqli_insert_id($con)
  //   ];
  //   echo json_encode($user);
  // }
  // else
  // {
  //   http_response_code(422);
  // }



}
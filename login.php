<?php

require 'database.php';

$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
  // Extract the data.
  $request = json_decode($postdata);

  $email = $request->email;
  $mdp = $request->mdp;


  $error = '';
  $verif = $con->prepare("SELECT * FROM user WHERE email = :email");
  $verif->bindValue(':email', $email, PDO::PARAM_STR);
  $verif->execute();


  if($verif->rowCount())
  {
      
      $user = $verif->fetch(PDO::FETCH_ASSOC);

      if(password_verify($mdp, $user['mdp']))
      {
                
        http_response_code(201);
        $success = $user;
        echo json_encode($success);      
          
      }
      else // Sinon le mot de passe ne correspond pas, on antre dans le ELSE
      {   
          http_response_code(422);
          $error = 'Identifiants invalide';
          echo json_encode($error);

      }

  }
  else //  SInon dans tout les autres cas, l'internaute a saisi un email invalide ou 
  {
    http_response_code(422);
    $error = 'Identifiants invalide';
    echo json_encode($error);
  }


}


?>
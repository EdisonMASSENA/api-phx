<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

// define('DB_HOST', 'localhost');
// define('DB_USER', 'root');
// define('DB_PASS', '');
// define('DB_NAME', 'phxtv');

function connect()
{
  // $connect = mysqli_connect(DB_HOST ,DB_USER ,DB_PASS ,DB_NAME);
  $bdd = new PDO('mysql:host=localhost; dbname=phxtv', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

  // if (mysqli_connect_errno()) {
  //   die("Failed to connect:" . mysqli_connect_error());
  // }

  // mysqli_set_charset($connect, "utf8");

  return $bdd;
}

$con = connect();

?>
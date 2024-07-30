<?php
include "db.php";
// Get the username and password from the request body
$Name = $_POST['Name'];
$Password = $_POST['Password'];

$result = $con->query("SELECT * FROM `user` WHERE `Name` = '$Name' AND `Password` = '$Password'");


if ($result->num_rows > 0) {
  // If the login is successful, return the user data as JSON
  $user = $result->fetch_assoc();
  $userId=$user['Id_User'];
  //$_SESSION['Id_User'] = $userId;
  $Id_Role=$user['Id_Role'];
  $data=array($userId,$Id_Role);
  header('Content-Type: application/json');
  echo json_encode($data);
} else {
  // If the login fails, return a 401 Unauthorized response
  http_response_code(401);
  echo 'Invalid email or password';
}


?>



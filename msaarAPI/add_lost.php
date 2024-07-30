<?php
include "db.php";
// Get the username and password from the request body
$Name = $_POST['Name'];
$Details=$_POST['Details'];
$Date=date('Y-m-d');
$Id_User = $_POST['Id_User'];
$sql1=mysqli_query($con,"SELECT Id_Driver FROM `driver` WHERE `Id_User`='$Id_User'");
$result1=mysqli_fetch_array($sql1);
$Id_Driver=$result1['Id_Driver'];
        
$sql = "INSERT INTO `lostthing` (`Name`, `Date`, `Id_Driver`,`Details`,`Id_State`) VALUES ('$Name', '$Date', '$Id_Driver','$Details','2')";

$result = mysqli_query($con, $sql);

if ($result) {
  // Insertion successful, return a success response
  $response = array(
    'success' => true,
  );
} else {
  // Insertion failed, return an error response
  $response = array(
    'success' => false,
  );
}

// Return the response as JSON
header('Content-Type: application/json');
echo json_encode($response);

?>


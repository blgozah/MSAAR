<?php
include "db.php";
$Id_User=$_POST['Id_User'];
$Name = $_POST['Name'];
$Password = $_POST['Password'];
$Phone=$_POST['Phone'];
$Email=$_POST['Email'];
$Id_Region=$_POST['Id_Region'];
$Id_College=$_POST['Id_College'];
// Retrieve data from MySQL table
$sql= " UPDATE `student` set `Id_Region`='$Id_Region',`Id_College`='$Id_College', `Phone`='$Phone' WHERE `Id_User`='$Id_User' )";
$result = mysqli_query($con, $sql);
$sql2= " UPDATE `user` set `Password`='$Password', `Name`='$Name',`Email`='$Email' WHERE `Id_User`='$Id_User' )";
$result2 = mysqli_query($con, $sql2);
// Output data in JSON format
if ($result and $result2) {
    $response = array(
        'success' => true,
        'message' => 'success',);
} else {
    // Insertion failed, return an error response
    $response = array(
      'success' => false,
      'message' => 'Failed',
    );
  }
  
  // Return the response as JSON
  header('Content-Type: application/json');
  echo json_encode($response);
?>



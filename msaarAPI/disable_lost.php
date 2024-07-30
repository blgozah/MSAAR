<?php
include "db.php";
$Id_LostThing=$_POST['Id_LostThing'];
// Retrieve data from MySQL table
$sql= " UPDATE `lostthing` set `Id_State`='1' WHERE `Id_LostThing`='$Id_LostThing'";
$result = mysqli_query($con, $sql);

// Output data in JSON format
if ($result) {
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



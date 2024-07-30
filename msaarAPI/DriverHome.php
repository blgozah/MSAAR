<?php
include "db.php";

// Get the Id_User and Id_Station from the request body
$Id_User = $_POST['Id_User'];

// Query the database to retrieve the Id_Driver for the given Id_User
$sql = "SELECT Id_Driver FROM driver WHERE Id_User = '$Id_User'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
  $Id_Driver = $row['Id_Driver'];
$sql6 = "SELECT Id_Bus FROM bus WHERE Id_Driver = '$Id_Driver'";
$result6 = mysqli_query($con, $sql6);
$row = mysqli_fetch_assoc($result6);
  $Id_Bus = $row['Id_Bus'];
if (mysqli_num_rows($result) > 0) {
  // Found the driver, retrieve the Id_Driver value
  

  // Query the database to retrieve the Id_Station and Id_Student values that have the same Id_Driver and Id_Station
  $DateNow = date('Y-m-d');
  $sql2 = "SELECT Id_Station, Id_Student FROM reservation WHERE EndDate > NOW() AND Id_Bus = '$Id_Bus' ORDER BY Id_Station ASC";
  $result2 = mysqli_query($con, $sql2);

  if (mysqli_num_rows($result2) > 0) {
    // Found reservations with the same driver and station, return the results as JSON
    $reservations = array();
$Station=array();
    while ($row2 = mysqli_fetch_assoc($result2)) {
      $Id_Station=$row2['Id_Station'];
$sql7= mysqli_query($con,"SELECT * FROM busstation where `Id_Station`='$Id_Station'");

while($row3=mysqli_fetch_assoc($sql7)){
  if ($row2['Id_Station'] = $row3['Id_Station']){
$Station[]=$row3['Name'];
  }
  $Id_Student=$row2['Id_Student'];
$sql4 = mysqli_query($con,"SELECT * FROM student where `Id_Student`='$Id_Student'");
    $result4=mysqli_fetch_array($sql4);
    $Id_User1=$result4['Id_User'];
    $sql5 = mysqli_query($con,"SELECT * FROM user where `Id_User`='$Id_User1'");
    $result5=mysqli_fetch_array($sql5);
    $Name=$result5['Name'];
      $reservation = array(
        'Station' => $row3['Name'],
        'Student' => $Name,
      );
      $reservations[] = $reservation;
}

    }
    $Station = array_unique($Station);
    $response = array(
      'success' => true,
      'reservations' => $reservations,
      'station'=>$Station,
    );
  } else {
    // No reservations found with the same driver and station
    $response = array(
      'success' => false,
      'message' => 'No reservations found for Driver ' . $Id_Driver,
    );
  }
} else {
  // Driver not found, return an error response
  $response = array(
    'success' => false,
    'message' => 'Driver not found',
  );
}

// Return the response as JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
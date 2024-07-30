<?php
include "db.php";
// Get the username and password from the request body
$Id_Card = $_POST['Id_Card'];
$Id_Station = $_POST['Id_Station'];
$Id_User = $_POST['Id_User'];
$DateNow=date('Y-m-d');
$check=false;
$sql2=mysqli_query($con,"SELECT Id_Student FROM `student` WHERE `Id_User`='$Id_User'");
$resultStudent=mysqli_fetch_array($sql2);
$Id_Student=$resultStudent['Id_Student'];
// Query the database to retrieve the user with the given username and password
$sql = "SELECT * FROM `card` WHERE `Id_Card`='$Id_Card' AND Id_State='2'";
$result1 = mysqli_query($con, $sql);
if (mysqli_num_rows($result1) > 0) {
$result=mysqli_fetch_array($result1);
$Id_Track=$result['Id_Track'];
$reservations = mysqli_query($con, "SELECT * FROM `reservation` WHERE `EndDate`>'$DateNow'");
$buss = mysqli_query($con, "SELECT * FROM `bus` WHERE `Id_Track`='$Id_Track'");
$reservation=array();
$bus=array();
while($row = $reservations->fetch_assoc()) {
  $reservation[] = $row;
}
while($row = $buss->fetch_assoc()) {
  $bus[] = $row;
}

foreach($bus as $row){
  $chiar=0;
  foreach($reservation as $row1){
    if($row['Id_Bus']==$row1['Id_Bus']){
      $chiar++;
    }
  }
  if($row['Chair_count']>$chiar){
    $Id_Bus=$row['Id_Bus'];
    $EndDate = date('Y-m-d', strtotime('+1 month'));
    $insert = mysqli_query($con, "INSERT INTO `reservation` (`StartDate`, `EndDate`,`Id_Track`,`Id_Bus`, `Id_Student`,`Id_State` ,`Id_Station`) VALUES ('$DateNow', '$EndDate', '$Id_Track','$Id_Bus', '$Id_Student', '2','$Id_Station')");
    if($insert){
      $update=mysqli_query($con," UPDATE `card` set `Id_State`='1' WHERE `Id_Card`='$Id_Card'");
      $response = array(
        'success' => true,
      );
      $check=true;
    }
  }
 
}
if($check==false){
  $response = array(
    'success' => false,
    'message' => 'all bus is fall',
  );
}
} else {
  // Authentication failed, return an error response
  $response = array(
    'success' => false,
    'message' => 'not found',
  );
}

// Return the response as JSON
header('Content-Type: application/json');
echo json_encode($response);

?>



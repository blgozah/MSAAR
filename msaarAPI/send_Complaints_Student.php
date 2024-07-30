<?php
include "db.php";
// Get the username and password from the request body
$DateNow=date('Y-m-d');
$Message = $_POST['Message'];
$Id_User = $_POST['Id_User'];
$sql2=mysqli_query($con,"SELECT Id_Student FROM `student` WHERE `Id_User`='$Id_User'");
$resultStudent=mysqli_fetch_array($sql2);
$Id_Student=$resultStudent['Id_Student'];
$sql=mysqli_query($con,"SELECT Id_Driver FROM `reservation` WHERE `Id_Student`='$Id_Student' and `EndDate`>'$DateNow'");
$result=mysqli_fetch_array($sql);
$Id_Driver=$result['Id_Driver'];
        
$sql = "INSERT INTO `complaints` (`Message`, `Id_Student`, `Id_Driver`,`Id_State`) VALUES ('$Message', '$Id_Student', '$Id_Driver','2')";

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



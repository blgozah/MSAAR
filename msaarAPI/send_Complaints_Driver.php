<?php
include "db.php";
// Get the username and password from the request body
$Message = $_POST['Message'];
$Id_Student=$_POST['Id_Student'];
$Id_User = $_POST['Id_User'];
$sql=mysqli_query($con,"SELECT Id_Driver FROM `driver` WHERE `Id_User`='$Id_User'");
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



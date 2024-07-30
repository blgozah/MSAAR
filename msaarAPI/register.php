<?php
include "db.php";
// Get the username and password from the request body
$Name = $_POST['Name'];
$Password = $_POST['Password'];
$Phone=$_POST['Phone'];
$Email=$_POST['Email'];
$Id_Student=$_POST['Id_Student'];
$Id_Region=$_POST['Id_Region'];
$Address=$_POST['Address'];
$Id_College=$_POST['Id_College'];
        

$sql = "INSERT INTO `user` (`Name`, `Password`, `Email`,`Id_Role`) VALUES ('$Name', '$Password', '$Email','3')";
$result = mysqli_query($con, $sql);
$IdUser = mysqli_query($con, "SELECT Id_User FROM `user` WHERE `Name`='$Name' AND  `Password`='$Password'");
$row = $IdUser->fetch_assoc();
$Id_User=$row['Id_User'];

$sql2 = "INSERT INTO `student` (`Id_Student`, `Address`, `Id_Region`,`Id_State`, `Id_College`, `Id_User`) VALUES ('$Id_Student', '$Address', '$Id_Region','2', '$Id_College', '$Id_User')";
$result2 = mysqli_query($con, $sql2);
if ($result and $result2) {
  // Insertion successful, return a success response
  $response = array(
    'success' => true,
    'message' => 'User registered successfully',
  );
} else {
  // Insertion failed, return an error response
  $response = array(
    'success' => false,
    'message' => 'Failed to register user',
  );
}

// Return the response as JSON
header('Content-Type: application/json');
echo json_encode($response);

?>



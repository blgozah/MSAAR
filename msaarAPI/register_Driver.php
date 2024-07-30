<?php
include "db.php";
$Id_Type=$_POST['Id_Type'];
// Get the username and password from the request body

  $Name = $_POST['Name'];

  $Password = $_POST['Password'];


  $Phone=$_POST['Phone'];

  $Email=$_POST['Email'];

  $Address=$_POST['Address'];


//$Password = $_POST['Password'];
//$Phone=$_POST['Phone'];
//$Email=$_POST['Email'];
//$Id_Driver=$_POST['Id_Driver'];
//$Address=$_POST['Address'];
//$License=$_POST['License']

$data=$_POST['data'];
$name=$_POST['name'];



$License="upload/$name";





$Chair_count=$_POST['Chair_count'];

$data2=$_POST['data2'];


$name2=$_POST['name2'];



$Image="upload/$name2";




        

$sql = "INSERT INTO `user` (`Name`, `Password`, `Email`,`Id_Role`) VALUES ('$Name', '$Password', '$Email','2')";
$IdUser = mysqli_query($con, "SELECT Id_User FROM `user` WHERE `Name`='$Name' AND  `Password`='$Password'");
$row = $IdUser->fetch_assoc();
$Id_User=$row['Id_User'];
$result = mysqli_query($con, $sql);
$sql = "SELECT Id_Driver FROM driver WHERE Id_User = '$Id_User'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
  $Id_Driver = $row['Id_Driver'];

$sql2 = "INSERT INTO `driver` (`Address`, `License`,`Phone`, `Id_State`, `Id_User`) VALUES ( '$Address', '$License','$Phone', '2', '$Id_User')";
file_put_contents($License,base64_decode($data));
$result2 = mysqli_query($con, $sql2);





$sql4 = "INSERT INTO `bus` (`Image`, `Chair_count`, `Id_Type`, `Id_Track`, `Id_State`, `Id_Driver`) VALUES ('$Image', '$Chair_count', '$Id_Type', '1', '2', '$Id_Driver')";
file_put_contents($Image,base64_decode($data2));
$result4 = mysqli_query($con, $sql4);



if ($result and $result2 and $result4) {
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





<?php
include "db.php";
$Id_User = $_POST['Id_User'];
$DateNow=date('Y-m-d');
$sql2=mysqli_query($con,"SELECT Id_Student FROM `student` WHERE `Id_User`='$Id_User'");
$resultStudent=mysqli_fetch_array($sql2);
$Id_Student=$resultStudent['Id_Student'];
// Retrieve data from MySQL table
$sql = mysqli_query($con,"SELECT * FROM reservation where `EndDate`>'$DateNow' and `Id_Student`='$Id_Student'");
$result =mysqli_fetch_array($sql);
$Id_Bus=$result['Id_Bus'];
$Id_Station=$result['Id_Station'];
$sql5= mysqli_query($con,"SELECT `Name` as Station FROM busstation where `Id_Station`='$Id_Station'");
$result5=mysqli_fetch_array($sql5);
$sql1= mysqli_query($con,"SELECT Id_Driver FROM bus where `Id_Bus`='$Id_Bus'");
$result1=mysqli_fetch_array($sql1);
$Id_Driver=$result1['Id_Driver'];
$sql3= mysqli_query($con,"SELECT Id_User FROM driver where `Id_Driver`='$Id_Driver'");
$result3=mysqli_fetch_array($sql3);
$Id_User1=$result3['Id_User'];
$sql4= mysqli_query($con,"SELECT `Name`  FROM user where `Id_User`='$Id_User1'");
$result4=mysqli_fetch_array($sql4);
// Output data in JSON format
$data = array($result+$result4+$result5);


echo json_encode($data);

?>



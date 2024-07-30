<?php
include "db.php";
$Id_User = $_POST['Id_User'];
$DateNow=date('Y-m-d');
$sql2=mysqli_query($con,"SELECT Id_Driver FROM `driver` WHERE `Id_User`='$Id_User'");
$resultStudent=mysqli_fetch_array($sql2);
$Id_Driver=$resultStudent['Id_Driver'];
$sql3=mysqli_query($con,"SELECT Id_Bus FROM `bus` WHERE `Id_Driver`='$Id_Driver'");
$result=mysqli_fetch_array($sql3);
$Id_Bus=$result['Id_Bus'];
// Retrieve data from MySQL table
$sql = mysqli_query($con,"SELECT * FROM reservation where `EndDate`>'$DateNow' and `Id_Bus`='$Id_Bus'");
$data=array();
while($row=mysqli_fetch_array($sql)){
    $Id_Student=$row['Id_Student'];
    $sql4 = mysqli_query($con,"SELECT * FROM student where `Id_Student`='$Id_Student'");
    $result4=mysqli_fetch_array($sql4);
    $Id_User1=$result4['Id_User'];
    $sql5 = mysqli_query($con,"SELECT * FROM user where `Id_User`='$Id_User1'");
    $result5=mysqli_fetch_array($sql5);
    $Name=$result5['Name'];
    $data[]=array(
        'Id_Student' => $Id_Student,
        'Name' => $Name,
    );
}
header('Content-Type: application/json');
echo json_encode($data);
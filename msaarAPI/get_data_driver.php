<?php
include "db.php";
$Id_User=intval($_POST['Id_User']);
// Retrieve data from MySQL table
$sql = "SELECT * FROM msaar.driver inner join msaar.user on msaar.driver.Id_User=msaar.user.Id_User where driver.Id_User ='$Id_User'";
$result = $con->query($sql);

// Output data in JSON format
$data = array();
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $data[] = $row;
  }
}
echo json_encode($data);

?>



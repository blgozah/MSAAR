<?php
include "db.php";
// Retrieve data from MySQL table
$sql = "SELECT * FROM college";
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



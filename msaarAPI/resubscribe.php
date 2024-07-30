<?php
include "db.php";

// Get the Id_Card and Id_User from the request body
$Id_Card = $_POST['Id_Card'];
$Id_User = $_POST['Id_User'];

// Query the database to retrieve the card with the given Id_Card and state=2
$sql = "SELECT * FROM `card` WHERE `Id_Card`='$Id_Card' AND `Id_State`=2";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
  // Found the card, retrieve the Id_Student from the student table using the given Id_User
  $sql2 = "SELECT `Id_Student` FROM `student` WHERE `Id_User`='$Id_User'";
  $result2 = mysqli_query($con, $sql2);

  if (mysqli_num_rows($result2) > 0) {
    // Found the student, check if they have a reservation that can be renewed
    $row2 = mysqli_fetch_array($result2);
    $Id_Student = $row2['Id_Student'];
    $sql3 = "SELECT * FROM `reservation` WHERE `Id_Student`='$Id_Student' AND DATE_ADD(`EndDate`, INTERVAL 2 DAY) > '".date('Y-m-d')."'";
    $result3 = mysqli_query($con, $sql3);

    if (mysqli_num_rows($result3) > 0) {
      // Found the reservation, update the end date
      $reservation = mysqli_fetch_array($result3);
      $newEndDate = date('Y-m-d', strtotime('+1 month'));
      $reservationId = $reservation['Id_Reservation'];
      $update = mysqli_query($con, "UPDATE `reservation` SET `EndDate`='$newEndDate' WHERE `Id_Reservation`='$reservationId'");
      if ($update) {
        $updateCard = mysqli_query($con, "UPDATE `card` SET `Id_State`='1' WHERE `Id_Card`='$Id_Card'");
        $response = array(
          'success' => true,
          'message' => 'Reservation renewed successfully',
        );
      } else {
        $response = array(
          'success' => false,
          'message' => 'Failed to renew reservation',
        );
      }
    } else {
      // Student does not have a current reservation, return an error response
      $response = array(
        'success' => false,
        'message' => 'Student does not have a current reservation that can be renewed',
      );
    }
  } else {
    // Student not found, return an error response
    $response = array(
      'success' => false,
      'message' => 'Student not found',
    );
  }
} else {
  // Card not found or state is not 2, return an error response
  $response = array(
    'success' => false,
    'message' => 'Card not found or state is not 2',
  );
}

// Return the response as JSON
header('Content-Type: application/json');
echo json_encode($response);
<?php 
// Start session 

 
// Include database configuration file 
require_once 'dbConfig.php'; 
include("auth_session.php");
// Set default redirect url 
$redirectURL = 'Cards.php'; 
$AdminId=$_SESSION["Id_Admin"];
if(isset($_POST['userSubmit'])){ 
    // Get form fields value 
    $Price = trim(strip_tags($_POST['Price']));
    $Id_Track = trim(strip_tags($_POST['Id_Track'])); 

    
   
     
   
   
     
    // Submitted form data 
    $userData = array( 
        'Price' => $Price, 
        'Id_Track' => $Id_Track ,
     
    ); 
     
    // Store the submitted field values in the session 
    $sessData['userData'] = $userData; 
   
        
            // generate unique serial number
$serial_number = '';
do {
   
   
    // Generate a random number between 100000 and 999999
$random_number = rand(100000, 999999);

// Concatenate $Id_Track and the random number
$number = $Id_Track . $random_number;

// Pad the serial number with leading zeros to make it 9 digits long
$serial_number = str_pad($number, 9, '0', STR_PAD_RIGHT);

    $stmt = mysqli_query($con,"SELECT * FROM `card` WHERE Id_Card = '$serial_number'");

    
} while (!$stmt);
            // Insert data in SQL server 
            $insert =  mysqli_query($con, "INSERT INTO `card` (Id_Card,`Price`,Id_Track,Id_Admin,Id_State,`Print`) VALUES ('$serial_number','$Price','$Id_Track','$AdminId','2','0')"); 
           
            if($insert){ 
                //$MemberID = $conn->lastInsertId(); 
                 
                $sessData['status']['type'] = 'success'; 
                $sessData['status']['msg'] = 'تمت الاضافة بنجاح'; 
                 
                // Remove submitted field values from session 
                unset($sessData['userData']); 
            }else{ 
                $sessData['status']['type'] = 'error'; 
                $sessData['status']['msg'] = 'هناك مشكلة حدثت'; 
                 
                // Set redirect url 
                $redirectURL = 'AddCard.php'.$id_str; 
            } 
       
     
    // Store status into the session 
    $_SESSION['sessData'] = $sessData; 
}elseif(($_REQUEST['action_type'] == 'print') && !empty($_GET['id'])){ 
    $Id_Card = $_GET['id']; 
    
// استعلام SQL لاسترداد البيانات المحددة من جدول البطاقات
$sql = "SELECT * FROM card WHERE Id_Card = '$Id_Card'";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
  // Create a new image
  $img = imagecreatetruecolor(300, 200);

  // Retrieve the data and display it in the image
  while ($row = mysqli_fetch_assoc($result)) {
    // Add the title and description of the card
    $text_color = imagecolorallocate($img, 0, 0, 0);
    $Id_Track=$row["Id_Track"];
    $stmt = mysqli_query($con,"SELECT * FROM `track` WHERE Id_Track = '$Id_Track'");
    $row2 = mysqli_fetch_array($stmt);
    $title = $row2["StartIn"]//+"الى"+$row2["EndIn"];
    $description = $row["Id_Card"];
    $font = "arial.ttf";
    imagettftext($img, 16, 0, 10, 180, $text_color, $font, $title);
    imagettftext($img, 12, 0, 10, 200, $text_color, $font, $description);
  }

  // Send the BMP file to the printer
  printer_draw_bmp($printer_handle, $img, 0, 0, 300, 200);

  // Delete the temporary file
  imagedestroy($img);
} else {
  echo "No data found!";
}
     
//     // Delete data from SQL server 
    
//     $delete = mysqli_query($con, "UPDATE region SET Id_State = 1 WHERE Id_Region=$Id_Region");
     
//     if($delete){ 
//         $sessData['status']['type'] = 'success'; 
//         $sessData['status']['msg'] = 'تم الحذف بنجاح'; 
//     }else{ 
//         $sessData['status']['type'] = 'error'; 
//         $sessData['status']['msg'] = 'هناك مشكله حدثت'; 
//     } 
     
//     // Store status into the session 
//     $_SESSION['sessData'] = $sessData; 
// }elseif(($_REQUEST['action_type'] == 'active') && !empty($_GET['id'])){ 
//         $Id_Region = $_GET['id']; 
         
//         // Delete data from SQL server 
//         $active = mysqli_query($con, "UPDATE region SET Id_State = 2 WHERE Id_Region=$Id_Region");
     
//         if($active){ 
//             $sessData['status']['type'] = 'success'; 
//             $sessData['status']['msg'] = 'تم التفعيل'; 
//         }else{ 
//             $sessData['status']['type'] = 'error'; 
//             $sessData['status']['msg'] = 'هناك مشكلة حدثت'; 
//         } 
//       // Store status into the session 
//     $_SESSION['sessData'] = $sessData;    
} 
 
// Redirect to the respective page 
header("Location:".$redirectURL); 
exit(); 
?>

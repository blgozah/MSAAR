<?php 
// Start session 
if(!session_id()){ 
    session_start(); 
} 
 
// Include database configuration file 
require_once 'dbConfig.php'; 
 
// Set default redirect url 
$redirectURL = 'BusStation.php'; 
 
if(isset($_POST['userSubmit'])){ 
    // Get form fields value 
    $Id_Station = $_POST['Id_Station']; 
    $Address = trim(strip_tags($_POST['Address'])); 
    $Id_Track = trim(strip_tags($_POST['Id_Track'])); 
    $Id_Region = trim(strip_tags($_POST['Id_Region'])); 
    $Id_State = trim(strip_tags($_POST['Id_State'])); 
     
    $id_str = ''; 
    if(!empty($id)){ 
        $id_str = '?id='.$Id_Station; 
    } 
     
    
     
    // Submitted form data 
    $userData = array( 
        'Address' => $Address, 
        'Id_Track' => $Id_Track, 
        'Id_Region' => $Id_Region, 
        'Id_State' => $Id_State 
    ); 
     
    // Store the submitted field values in the session 
    $sessData['userData'] = $userData; 
     
    // Process the form data 
    
        if(!empty($Id_Station)){ 
            // Update data in SQL server 
            $update = mysqli_query($con, "UPDATE busstation SET `Address` ='$Address', Id_Track ='$Id_Track',Id_Region ='$Id_Region' ,Id_State ='$Id_State' WHERE Id_Station=$Id_Station");
            
            if($update){ 
                $sessData['status']['type'] = 'success'; 
                $sessData['status']['msg'] = 'تمت العملية بنجاح'; 
                 
                // Remove submitted field values from session 
                unset($sessData['userData']); 
            }else{ 
                $sessData['status']['type'] = 'error'; 
                $sessData['status']['msg'] = 'هناك مشكلة حدثت'; 
                 
                // Set redirect url 
                $redirectURL = 'addEditStation.php'.$id_str; 
            } 
        }else{ 
            // Insert data in SQL server 
            $insert =  mysqli_query($con, "INSERT INTO busstation (`Address`, Id_Track,Id_Region ,Id_State) VALUES ('$Address', '$Id_Track','$Id_Region','$Id_State')"); 
           
             
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
                $redirectURL = 'addEditStation.php'.$id_str; 
            } 
        } 
    
     
    // Store status into the session 
    $_SESSION['sessData'] = $sessData; 
}elseif(($_REQUEST['action_type'] == 'delete') && !empty($_GET['id'])){ 
    $Id_Station = $_GET['id']; 
     
    // Delete data from SQL server 
    
    $delete = mysqli_query($con, "UPDATE busstation SET Id_State = 1 WHERE Id_Station=$Id_Station");
     
    if($delete){ 
        $sessData['status']['type'] = 'success'; 
        $sessData['status']['msg'] = 'تم الحذف بنجاح'; 
    }else{ 
        $sessData['status']['type'] = 'error'; 
        $sessData['status']['msg'] = 'هناك مشكله حدثت'; 
    } 
     
    // Store status into the session 
    $_SESSION['sessData'] = $sessData; 
}elseif(($_REQUEST['action_type'] == 'active') && !empty($_GET['id'])){ 
        $Id_Station = $_GET['id']; 
         
        // Delete data from SQL server 
        $delete = mysqli_query($con, "UPDATE busstation SET Id_State = 2 WHERE Id_Station=$Id_Station");
     
        if($delete){ 
            $sessData['status']['type'] = 'success'; 
            $sessData['status']['msg'] = 'تم التفعيل'; 
        }else{ 
            $sessData['status']['type'] = 'error'; 
            $sessData['status']['msg'] = 'هناك مشكلة حدثت'; 
        } 
      // Store status into the session 
    $_SESSION['sessData'] = $sessData;    
} 
 
// Redirect to the respective page 
header("Location:".$redirectURL); 
exit(); 
?>

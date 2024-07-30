<?php 
// Start session 
if(!session_id()){ 
    session_start(); 
} 
 
// Include database configuration file 
require_once 'dbConfig.php'; 
 
// Set default redirect url 
$redirectURL = 'Students.php'; 
 
if(($_REQUEST['action_type'] == 'delete') && !empty($_GET['id'])){ 
    $Id_Student = $_GET['id']; 
     
    // Delete data from SQL server 
    
    $delete = mysqli_query($con, "UPDATE student SET Id_State = 3 WHERE Id_Student=$Id_Student");
     
    if($delete){ 
        $sessData['status']['type'] = 'success'; 
        $sessData['status']['msg'] = 'تم حظر الطالب بنجاح'; 
    }else{ 
        $sessData['status']['type'] = 'error'; 
        $sessData['status']['msg'] = 'هناك مشكله حدثت'; 
    } 
     
    // Store status into the session 
    $_SESSION['sessData'] = $sessData; 
}elseif(($_REQUEST['action_type'] == 'active') && !empty($_GET['id'])){ 
        $Id_Student = $_GET['id']; 
         
        // Delete data from SQL server 
        $delete = mysqli_query($con, "UPDATE student SET Id_State = 2 WHERE Id_Student=$Id_Student");
     
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

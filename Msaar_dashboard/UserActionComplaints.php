<?php 
// Start session 
if(!session_id()){ 
    session_start(); 
} 
 
// Include database configuration file 
require_once 'dbConfig.php'; 
 
// Set default redirect url 
$redirectURL = 'Complaints.php'; 
 
if(($_REQUEST['action_type'] == 'delete') && !empty($_GET['id'])){ 
    $Id_Complaint = $_GET['id']; 
     
    // Delete data from SQL server 
    
    $delete = mysqli_query($con, "UPDATE complaints SET Id_State = 3 WHERE Id_Complaint=$Id_Complaint");
     
    if($delete){ 
        $sessData['status']['type'] = 'success'; 
        $sessData['status']['msg'] = 'تمت المعالجة بنجاح'; 
    }else{ 
        $sessData['status']['type'] = 'error'; 
        $sessData['status']['msg'] = 'هناك مشكله حدثت'; 
    } 
     
    // Store status into the session 
    $_SESSION['sessData'] = $sessData; 
}

// Redirect to the respective page 
header("Location:".$redirectURL); 
exit(); 
?>

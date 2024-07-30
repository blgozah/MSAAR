<?php 
// Start session 
if(!session_id()){ 
    session_start(); 
} 
 
// Include database configuration file 
require_once 'dbConfig.php'; 
 
// Set default redirect url 
$redirectURL = 'tracks.php'; 
 
if(isset($_POST['userSubmit'])){ 
    // Get form fields value 
    $Id_User = $_POST['Id_User']; 
    $Name = trim(strip_tags($_POST['Name'])); 
    $Email = trim(strip_tags($_POST['Email'])); 
    $Phone = trim(strip_tags($_POST['Phone'])); 
    $Password = trim(strip_tags($_POST['Password'])); 
    
    
    $errorMsg = ''; 
    if(empty($Name) or empty($Phone)or empty($Email)or empty($Password) ){ 
        $errorMsg .= 'الرجاء تعبئة جميع الحقول'; 
    } 
     
    // Submitted form data 
    $userData = array( 
        'Name' => $Name, 
        'Email' => $Email, 
        'Phone' => $Phone, 
        'Password' => $Password 
    ); 
     
    // Store the submitted field values in the session 
    $sessData['userData'] = $userData; 
     
    // Process the form data 
    if(empty($errorMsg)){
            // Update data in SQL server 
            $update = mysqli_query($con, "UPDATE `user` SET `Name` ='$Name', Email ='$Email',`Password` ='$Password' WHERE Id_User='$Id_Uesr'");
            $update2= mysqli_query($con, "UPDATE `admin` SET `Phone` ='$Phone' WHERE Id_User='$Id_Uesr'");
            
            if($update and $update2){ 
                $sessData['status']['type'] = 'success'; 
                $sessData['status']['msg'] = 'تمت العملية بنجاح'; 
                 
                // Remove submitted field values from session 
                unset($sessData['userData']); 
            }else{ 
                $sessData['status']['type'] = 'error'; 
                $sessData['status']['msg'] = 'هناك مشكلة حدثت'; 
                 
                // Set redirect url 
                $redirectURL = 'AdminInfo.php'.$Id_Uesr; 
            } 
       
     
    // Store status into the session 
    $_SESSION['sessData'] = $sessData; }
    else{
        $sessData['status']['type'] = 'error'; 
        $sessData['status']['msg'] = $errorMsg;
         
        // Set redirect url 
        $redirectURL = 'AdminInfo.php'.$Id_Uesr;
    }
        }
 
// Redirect to the respective page 
header("Location:".$redirectURL); 
exit(); 
?>

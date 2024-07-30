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
    $Id_Track = $_POST['Id_Track']; 
    $StartIn = trim(strip_tags($_POST['StartIn'])); 
    $EndIn = trim(strip_tags($_POST['EndIn'])); 
    $Note = trim(strip_tags($_POST['Note'])); 
    $Id_State = trim(strip_tags($_POST['Id_State'])); 
     
    $id_str = ''; 
    if(!empty($id)){ 
        $id_str = '?id='.$Id_Track; 
    } 
     
    // Fields validation 
    $errorMsg = ''; 
    if(empty($StartIn)){ 
        $errorMsg .= '<p>الرجاء ادخال نقطة البداية</p>'; 
    } 
    if(empty($EndIn)){ 
        $errorMsg .= '<p>الرجاء ادخال نقطة النهاية</p>'; 
    } 
     
    // Submitted form data 
    $userData = array( 
        'StartIn' => $StartIn, 
        'EndIn' => $EndIn, 
        'Note' => $Note, 
        'Id_State' => $Id_State 
    ); 
     
    // Store the submitted field values in the session 
    $sessData['userData'] = $userData; 
     
    // Process the form data 
    if(empty($errorMsg)){ 
        if(!empty($Id_Track)){ 
            // Update data in SQL server 
            $update = mysqli_query($con, "UPDATE track SET StartIn ='$StartIn', EndIn ='$EndIn',Note ='$Note' ,Id_State ='$Id_State' WHERE Id_Track=$Id_Track");
            
            if($update){ 
                $sessData['status']['type'] = 'success'; 
                $sessData['status']['msg'] = 'تمت العملية بنجاح'; 
                 
                // Remove submitted field values from session 
                unset($sessData['userData']); 
            }else{ 
                $sessData['status']['type'] = 'error'; 
                $sessData['status']['msg'] = 'هناك مشكلة حدثت'; 
                 
                // Set redirect url 
                $redirectURL = 'addEditTrack.php'.$id_str; 
            } 
        }else{ 
            // Insert data in SQL server 
            $insert =  mysqli_query($con, "INSERT INTO track (StartIn, EndIn,Note ,Id_State) VALUES ('$StartIn', '$EndIn','$Note','$Id_State')"); 
           
             
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
                $redirectURL = 'addEditTrack.php'.$id_str; 
            } 
        } 
    }else{ 
        $sessData['status']['type'] = 'error'; 
        $sessData['status']['msg'] = '<p>الرجاء تعبئة كل الحقول</p>'.$errorMsg; 
         
        // Set redirect url 
        $redirectURL = 'addEditTrack.php'.$id_str; 
    } 
     
    // Store status into the session 
    $_SESSION['sessData'] = $sessData; 
}elseif(($_REQUEST['action_type'] == 'delete') && !empty($_GET['id'])){ 
    $Id_Track = $_GET['id']; 
     
    // Delete data from SQL server 
    
    $delete = mysqli_query($con, "UPDATE track SET Id_State = 1 WHERE Id_Track=$Id_Track");
     
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
        $Id_Track = $_GET['id']; 
         
        // Delete data from SQL server 
        $delete = mysqli_query($con, "UPDATE track SET Id_State = 2 WHERE Id_Track=$Id_Track");
     
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

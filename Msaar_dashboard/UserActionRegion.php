<?php 
// Start session 
if(!session_id()){ 
    session_start(); 
} 
 
// Include database configuration file 
require_once 'dbConfig.php'; 
 
// Set default redirect url 
$redirectURL = 'regions.php'; 
 
if(isset($_POST['userSubmit'])){ 
    // Get form fields value 
    $Id_Region = $_POST['Id_Region']; 
    $Name = trim(strip_tags($_POST['Name'])); 
    $Id_State = trim(strip_tags($_POST['Id_State'])); 
     
    $id_str = ''; 
    if(!empty($id)){ 
        $id_str = '?id='.$Id_Region; 
    } 
     
    // Fields validation 
    $errorMsg = ''; 
    if(empty($Name)){ 
        $errorMsg .= '<p>الرجاء ادخال اسم المنطقة</p>'; 
    } 
   
     
    // Submitted form data 
    $userData = array( 
        'Name' => $Name, 
        'Id_State' => $Id_State 
    ); 
     
    // Store the submitted field values in the session 
    $sessData['userData'] = $userData; 
     
    // Process the form data 
    if(empty($errorMsg)){ 
        if(!empty($Id_Region)){ 
            // Update data in SQL server 
            $update = mysqli_query($con, "UPDATE region SET `Name` ='$Name' ,Id_State ='$Id_State' WHERE Id_Region=$Id_Region");
            
            if($update){ 
                $sessData['status']['type'] = 'success'; 
                $sessData['status']['msg'] = 'تمت العملية بنجاح'; 
                 
                // Remove submitted field values from session 
                unset($sessData['userData']); 
            }else{ 
                $sessData['status']['type'] = 'error'; 
                $sessData['status']['msg'] = 'هناك مشكلة حدثت'; 
                 
                // Set redirect url 
                $redirectURL = 'AddEditRegion.php'.$id_str; 
            } 
        }else{ 
            // Insert data in SQL server 
            $insert =  mysqli_query($con, "INSERT INTO region (`Name` ,Id_State) VALUES ('$Name','$Id_State')"); 
           
             
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
                $redirectURL = 'AddEditRegion.php'.$id_str; 
            } 
        } 
    }else{ 
        $sessData['status']['type'] = 'error'; 
        $sessData['status']['msg'] = '<p>الرجاء تعبئة كل الحقول</p>'.$errorMsg; 
         
        // Set redirect url 
        $redirectURL = 'AddEditRegion.php'.$id_str; 
    } 
     
    // Store status into the session 
    $_SESSION['sessData'] = $sessData; 
}elseif(($_REQUEST['action_type'] == 'delete') && !empty($_GET['id'])){ 
    $Id_Region = $_GET['id']; 
     
    // Delete data from SQL server 
    
    $delete = mysqli_query($con, "UPDATE region SET Id_State = 1 WHERE Id_Region=$Id_Region");
     
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
        $Id_Region = $_GET['id']; 
         
        // Delete data from SQL server 
        $active = mysqli_query($con, "UPDATE region SET Id_State = 2 WHERE Id_Region=$Id_Region");
     
        if($active){ 
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

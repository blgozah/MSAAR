<?php 
// Start session 
if(!session_id()){ 
    session_start(); 
} 
 
// Include database configuration file 
require_once 'dbConfig.php'; 
 
// Set default redirect url 
$redirectURL = 'colleges.php'; 
 
if(isset($_POST['userSubmit'])){ 
    // Get form fields value 
    $Id_College = $_POST['Id_College']; 
    $Name = trim(strip_tags($_POST['Name'])); 
    $Id_Region = trim(strip_tags($_POST['Id_Region'])); 
     
    $id_str = ''; 
    if(!empty($id)){ 
        $id_str = '?id='.$Id_College; 
    } 
     
    // Fields validation 
    $errorMsg = ''; 
    if(empty($Name)){ 
        $errorMsg .= '<p>الرجاء ادخال اسم الكلية</p>'; 
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
        if(!empty($Id_College)){ 
            // Update data in SQL server 
            $update = mysqli_query($con, "UPDATE college SET `Name` ='$Name' ,Id_Region ='$Id_Region' WHERE Id_College=$Id_College");
            
            if($update){ 
                $sessData['status']['type'] = 'success'; 
                $sessData['status']['msg'] = 'تمت العملية بنجاح'; 
                 
                // Remove submitted field values from session 
                unset($sessData['userData']); 
            }else{ 
                $sessData['status']['type'] = 'error'; 
                $sessData['status']['msg'] = 'هناك مشكلة حدثت'; 
                 
                // Set redirect url 
                $redirectURL = 'AddEditCollege.php'.$id_str; 
            } 
        }else{ 
            // Insert data in SQL server 
            $insert =  mysqli_query($con, "INSERT INTO college (`Name` ,Id_Region) VALUES ('$Name','$Id_Region')"); 
           
             
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
                $redirectURL = 'AddEditCollege.php'.$id_str; 
            } 
        } 
    }else{ 
        $sessData['status']['type'] = 'error'; 
        $sessData['status']['msg'] = '<p>الرجاء تعبئة كل الحقول</p>'.$errorMsg; 
         
        // Set redirect url 
        $redirectURL = 'AddEditCollege.php'.$id_str; 
    } 
     
    // Store status into the session 
    $_SESSION['sessData'] = $sessData; 
}
 
// Redirect to the respective page 
header("Location:".$redirectURL); 
exit(); 
?>

<?php 
// Start session 
if(!session_id()){ 
    session_start(); 
} 
 
// Include database configuration file 
require_once 'dbConfig.php'; 
 
// Set default redirect url 
$redirectURL = 'Drivers.php'; 
$searchErr = '';
$employee_details='';
if(isset($_POST['save']))
{
	if(!empty($_POST['search']))
	{
		$search = $_POST['search'];
		$stmt = $con->prepare("select * from employee_info where department like '%$search%' or name like '%$search%'");
		$stmt->execute();
		$employee_details = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
	}
	else
	{
		$searchErr = "Please enter the information";
	}
   
}
 
elseif(($_REQUEST['action_type'] == 'delete') && !empty($_GET['id'])){ 
    $Id_Driver = $_GET['id']; 
     
    // Delete data from SQL server 
    
    $delete = mysqli_query($con, "UPDATE driver SET Id_State = 3 WHERE Id_Driver=$Id_Driver");
     
    if($delete){ 
        $sessData['status']['type'] = 'success'; 
        $sessData['status']['msg'] = 'تم حظر السائق بنجاح'; 
    }else{ 
        $sessData['status']['type'] = 'error'; 
        $sessData['status']['msg'] = 'هناك مشكله حدثت'; 
    } 
     
    // Store status into the session 
    $_SESSION['sessData'] = $sessData; 
}elseif(($_REQUEST['action_type'] == 'active') && !empty($_GET['id'])){ 
        $Id_Driver = $_GET['id']; 
         
        // Delete data from SQL server 
        $delete = mysqli_query($con, "UPDATE driver SET Id_State = 2 WHERE Id_Driver=$Id_Driver");
     
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

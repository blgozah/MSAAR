<?php 
 
// Start session
if(!session_id()){ 
    session_start(); 
} 
// Retrieve session data 
$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:''; 
$userData = array();
// Get status message from session 
if(!empty($sessData['status']['msg'])){ 
    $statusMsg = $sessData['status']['msg']; 
    $statusMsgType = $sessData['status']['type']; 
    unset($_SESSION['sessData']['status']); 
} 
require_once 'dbConfig.php'; 
$Id_User=$_SESSION['Id_User'];
$User = mysqli_query($con, "SELECT * FROM `user` where Id_User='$Id_User'");
$user= mysqli_fetch_array($User);
$Admin = mysqli_query($con, "SELECT * FROM `admin` where Id_User='$Id_User'");
$admin=mysqli_fetch_array($Admin);
   
$userData = !empty($sessData['userData'])?$sessData['userData']:($user+$admin); 
unset($_SESSION['sessData']['userData']); 
 
$actionLabel = 'Edit'; 
 
?>

<!-- Display status message -->
<?php if(!empty($statusMsg) && ($statusMsgType == 'success')){ ?>
<div class="col-xs-12">
    <div class="alert alert-success"><?php echo $statusMsg; ?></div>
</div>
<?php }elseif(!empty($statusMsg) && ($statusMsgType == 'error')){ ?>
<div class="col-xs-12">
    <div class="alert alert-danger"><?php echo $statusMsg; ?></div>
</div>
<?php } ?>
<title>حسابي</title>
<link rel="stylesheet" href="assets/css/bootstrap.css">
    
    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
<section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                    <div class="float-right">
    
    <h4 class="card-title">معلومات حسابي</h4>
</div>
                    </div>
                    
                    <div class="card-content">
                        <div class="card-body">
                        
                            <form method="post" class="form" action="UserActionAdmin.php">
                                <div class="row">
                              
                                <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="city-column">الاسم</label>
                                            <input type="text" id="city-column" class="form-control" placeholder="الاسم" name="Name" value="<?php echo !empty($userData['Name'])?$userData['Name']:'';?>" >
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column"> البريد الالكتروني </label>
                                            <input type="text" id="city-column" class="form-control" placeholder="البريد الالكتروني" name="Email" value="<?php echo $userData['Email'] ?>" >
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="city-column">المنطقة </label>
                                            <input type="text" id="city-column" class="form-control" placeholder="رقم الهاتف " name="Phone" value="<?php echo $userData['Phone'] ?>" >
                                        </div>
                                    </div>
                                   
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="country-floating">الرقم السري</label>
                                            <input type="password" id="city-column" class="form-control" placeholder="الرقم السري" name="Password" value="<?php echo $userData['Password'] ?>" >
                                        
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="col-12 d-flex justify-content-end">
                                    <input type="hidden" name="Id_User" value="<?php echo $Id_User; ?>">
                                    <a href="index.php" class="btn btn-outline-primary mr-1 mb-1">رجوع</a>
                                    <input type="submit" name="userSubmit" class="btn btn-primary mr-1 mb-1" value="حفظ">
                                    
                                    </div>
                                    
                                </div>
                                </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
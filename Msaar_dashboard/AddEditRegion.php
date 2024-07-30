<?php 
 
// Start session 
if(!session_id()){ 
    session_start(); 
} 
 
// Retrieve session data 
$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:''; 
 
// Get status message from session 
if(!empty($sessData['status']['msg'])){ 
    $statusMsg = $sessData['status']['msg']; 
    $statusMsgType = $sessData['status']['type']; 
    unset($_SESSION['sessData']['status']); 
} 
require_once 'dbConfig.php'; 
// Get member data 
$memberData = $userData = array(); 
if(!empty($_GET['id'])){ 
    // Include database configuration file 
   
     $Id=$_GET['id'];
    // Fetch data from SQL server by row ID 
    $region = mysqli_query($con, "SELECT * FROM region WHERE Id_Region=$Id");
   $memberData=mysqli_fetch_array($region);
    
    
} 
$region = mysqli_query($con, "SELECT * FROM region");
$region2=array();
while ($row = mysqli_fetch_array($region)){
array_push($region2, $row);
}
$state= mysqli_query($con, "SELECT * FROM `state`");
    $State =array();
    while ($row = mysqli_fetch_array($state)){
    array_push($State, $row);
    }
$userData = !empty($sessData['userData'])?$sessData['userData']:$memberData; 
unset($_SESSION['sessData']['userData']); 
 
$actionLabel = !empty($_GET['id'])?'Edit':'Add'; 
 
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
<title>المناطق</title>
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
    
    <h4 class="card-title">المناطق</h4>
</div>
                    </div>
                    
                    <div class="card-content">
                        <div class="card-body">
                        
                            <form method="post" class="form" action="UserActionRegion.php">
                                <div class="row">
                              
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">اسم المنطقة</label>
                                            <input type="text" id="first-name-column" class="form-control" placeholder="اسم المنطقة" name="Name" value="<?php echo !empty($userData['Name'])?$userData['Name']:''; ?>" required="">
                                        
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="country-floating">الحالة</label>
                                            <select id="country-floating" class="form-control" name="Id_State" value="Id_State" required="">
                                            <?php if (empty($userData)){?>
                                                <?php $count2 = 0; foreach($State as $row1){ $count2++;?>
                                            <option value="<?php echo $row1['Id_State'] ?>"  ><?php echo $row1['Name']; }?></option>
                                                <?php }else{ $count = 0; foreach($State as $row1){ $count++;if($userData['Id_State']==$row1['Id_State']){ ?>
                                            <option value="<?php echo $row1['Id_State'] ?>" selected ><?php echo $row1['Name'];}} ?></option>
                                            <?php $count2 = 0; foreach($State as $row1){ $count2++;if($userData['Id_State']!=$row1['Id_State']){ ?>
                                            <option value="<?php echo $row1['Id_State'] ?>"  ><?php echo $row1['Name'];} }}?></option>
                                           
                                           
                                        </select>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="col-12 d-flex justify-content-end">
                                    <input type="hidden" name="Id_Region" value="<?php echo !empty($userData['Id_Region'])?$userData['Id_Region']:''; ?>">
                                    <a href="regions.php" class="btn btn-outline-primary mr-1 mb-1">رجوع</a>
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
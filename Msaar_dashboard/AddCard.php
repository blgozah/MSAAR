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

$Track = mysqli_query($con, "SELECT * FROM track");
$track=array();
while ($row = mysqli_fetch_array($Track)){
    array_push($track, $row);
    }
$actionLabel ='Add'; 
 
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
<title>الكروت</title>
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
    
    <h4 class="card-title">الكروت</h4>
</div>
                    </div>
                    
                    <div class="card-content">
                        <div class="card-body">
                        
                            <form method="post" class="form" action="userActionCard.php">
                                <div class="row">
                              
                                <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="city-column">السعر</label>
                                            <input type="text" id="city-column" class="form-control" placeholder="السعر" name="Price" value="" >
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column"> المسار </label>
                                            <select id="first-name-column" class="form-control"  name="Id_Track" value="Id_Track" required="">
                                            <?php if (empty($userData)){?>
                                                <?php $count2 = 0; foreach($track as $row1){ $count2++;?>
                                            <option value="<?php echo $row1['Id_Track'] ?>"  ><?php echo $row1['Id_Track']; }?></option>
                                                <?php }else{ $count = 0; foreach($track as $row1){ $count++;if($userData['Id_Track']==$row1['Id_Track']){ ?>
                                            <option value="<?php echo $row1['Id_Track'] ?>" selected ><?php echo $row1['Id_Track'];}} ?></option>
                                            <?php $count2 = 0; foreach($track as $row1){ $count2++;if($userData['Id_Track']!=$row1['Id_Track']){ ?>
                                            <option value="<?php echo $row1['Id_Track'] ?>"  ><?php echo $row1['Id_Track'];} }}?></option>
                                           
                                           
                                           
                                           
                                            

                                        </select>
                                        
                                        </div>
                                    </div>
                                    
                                    <div class="col-12 d-flex justify-content-end">
                                    
                                    <a href="Cards.php" class="btn btn-outline-primary mr-1 mb-1">رجوع</a>
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
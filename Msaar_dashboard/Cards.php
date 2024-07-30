<?php 
 
// Start session 

 
// Retrieve session data 
$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:''; 
 
// Get status message from session 
if(!empty($sessData['status']['msg'])){ 
    $statusMsg = $sessData['status']['msg']; 
    $statusMsgType = $sessData['status']['type']; 
    unset($_SESSION['sessData']['status']); 
} 

// Include database configuration file 
require_once 'dbConfig.php'; 
 
// Fetch the data from SQL server 
$Track = mysqli_query($con, "SELECT * FROM track");
$track=array();
while ($row = mysqli_fetch_array($Track)){
    array_push($track, $row);
    }
    $User = mysqli_query($con, "SELECT * FROM `user`");
    $user=array();
    while ($row = mysqli_fetch_array($User)){
        array_push($user, $row);
        }
    $Card=mysqli_query($con, "SELECT * FROM `card`");
    $card=array();
    while ($row = mysqli_fetch_array($Card)){
        array_push($card, $row);
        }
$Admin = mysqli_query($con, "SELECT * FROM `admin`");
$admin=array();
while ($row = mysqli_fetch_array($Admin)){
    array_push($admin, $row);
    }
$state= mysqli_query($con, "SELECT * FROM `state`");
    $State =array();
    while ($row = mysqli_fetch_array($state)){
    array_push($State, $row);
    }
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
<?php } 
require_once 'header.php';
?>

    
    <!-- List the members -->
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <!-- Add link -->
        
                        <a href="addCard.php" class="btn btn-primary"><i class="plus"></i>إضافة كروت</a>
                          
        <div class="float-right">
    
        <h4 class="card-title">كروت الرصيد</h4>
</div>
</div>
                    </div>
                    
                    <div class="card-content">
                        <div class="card-body">
                        <div class="col-md-6 mb-1">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg></span>
                                        <input type="text" class="form-control" placeholder="... أبحث هنا" aria-label="Recipient's username" aria-describedby="button-addon2">
                                        <button class="btn btn-primary" type="button" id="button-addon2">ابحث</button>
                                    </div>
                                </div>
    <div class="row" id="table-striped">
    <div class="table-responsive">

          <table class="table table-striped mb-0">
            <thead>
              <tr>
              <th>رقم الكرت </th>
                <th> السعر</th>
                <th>المسار </th>
                <th>اسم الادمن</th>
                <th>الحاله</th>
                <th>الطباعة</th>
                <th></th>
              </tr>
            </thead>
        <tbody>
        <?php if(!empty($card)){ $count = 0; foreach($card as $row){ $count++; ?>
            <tr>
                <td><?php echo $row['Id_Card']; ?></td>
                <td><?php echo $row['Price']; ?></td>
                <td><a href="TrackDetails.php?id=<?php echo $row['Id_Track']; ?>" ><?php echo $row['Id_Track']; ?></a></td>
                <td><?php  $count3 = 0; foreach($user as $row1){ $count3++; $count2 = 0; foreach($admin as $row2){ $count2++; if($row2['Id_User']==$row1['Id_User'] and $row2['Id_Admin']==$row['Id_Admin']){ echo $row1['Name'];}}} ?></td>
                <td><?php $count2 = 0; foreach($State as $row3){ $count2++; if($row['Id_State']==$row3['Id_State']){ echo $row3['Name'];}} ?></td>
                <td>
                <?php if($row['Print']==0){ ?>
                    <a href="UserActionCard.php?action_type=print&id=<?php echo $row['Id_Card']; ?>" class="btn btn-primary" >طباعة </a>
                    
                    <?php }else{ ?>
                        <td>مطبوعة</td>
                        <?php } ?>
                
            </tr>
            <?php } }else{ ?>
            <tr><td colspan="7">لا يوجد كروت مضافة</td></tr>
            <?php } ?>
        </tbody>
    
    </table>
</div>
            </div>
            </div>
            </div>
            </div>
    </section>
</div>
<?php
require_once 'footer.php';
?>

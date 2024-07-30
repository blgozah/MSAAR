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
$User = mysqli_query($con, "SELECT * FROM `user`");
$user=array();
while ($row = mysqli_fetch_array($User)){
    array_push($user, $row);
    }
$Student = mysqli_query($con, "SELECT * FROM student");
$student=array();
while ($row = mysqli_fetch_array($Student)){
    array_push($student, $row);
    }
$Driver = mysqli_query($con, "SELECT * FROM driver");
$driver=array();
while ($row = mysqli_fetch_array($Driver)){
        array_push($driver, $row);
        }
$Complaint = mysqli_query($con, "SELECT * FROM complaints");
$complaint=array();
while ($row = mysqli_fetch_array($Complaint)){
        array_push($complaint, $row);
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
        
                       
        <div class="float-right">
    
        <h4 class="card-title"> الشكاوي</h4>
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
              <th>رقم الشكوى </th>
                <th> اسم الطالب</th>
                <th>اسم السائق </th>
                <th> الشكوى</th>
               
                <th>الحالة</th>
              </tr>
            </thead>
        <tbody>
        <?php if(!empty($complaint)){ $count = 0; foreach($complaint as $row){ $count++; ?>
            <tr>
                <td><?php echo $row['Id_Complaint']; ?></td>
                <td><?php $count3 = 0; foreach($user as $row1){ $count3++; $count2 = 0; foreach($student as $row2){ $count2++; if($row2['Id_User']==$row1['Id_User'] and $row2['Id_Student']==$row['Id_Student']){ echo $row1['Name'];}}} ?></td>
                <td><?php $count3 = 0; foreach($user as $row1){ $count3++;$count2 = 0; foreach($driver as $row2){ $count2++; if($row2['Id_Driver']==$row['Id_Driver'] and $row2['Id_User']==$row1['Id_User']){ echo $row1['Name'];}}} ?></td>
                <td><?php echo $row['Message']; ?></td>
                <td><?php $count2 = 0; foreach($State as $row3){ $count2++; if($row['Id_State']==$row3['Id_State']){ echo $row3['Name'];}} ?></td>
               
                <td>
                <?php if($row['Id_State']==2){ ?>
                    <a href="UserActionComplaints.php?action_type=delete&id=<?php echo $row['Id_Complaint']; ?>" class="btn btn-success" onclick="return confirm('هل انت متاكد ؟');"> تمت المعالجة</a>
                    <?php }else{ ?>
                        <td>تمت المعالجة</td>
                        <?php } ?>
                    
                    </td>
               
            </tr>
            <?php } }else{ ?>
            <tr><td colspan="7">لا يوجد سجل </td></tr>
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

<?php 
 

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
        $Attend = mysqli_query($con, "SELECT * FROM attendance");
    $attend=array();
    while ($row = mysqli_fetch_array($Attend)){
        array_push($attend, $row);
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
    
        <h4 class="card-title">سجل الحضور</h4>
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
              <th>الرقم </th>
              <th> التاريخ </th>
                <th> اسم الطالب</th>
                <th>اسم السائق </th>
               
                <th></th>
              </tr>
            </thead>
        <tbody>
        <?php if(!empty($attend)){ $count = 0; foreach($attend as $row){ $count++; ?>
            <tr>
                <td><?php echo $row['Id_Attendance']; ?></td>
                <td><?php echo $row['Date']; ?></td>
                <td><?php $count3 = 0; foreach($user as $row1){ $count3++; $count2 = 0; foreach($student as $row2){ $count2++; if($row2['Id_User']==$row1['Id_User'] and $row2['Id_Student']==$row['Id_Student']){ echo $row1['Name'];}}} ?></td>
                <td><?php $count3 = 0; foreach($user as $row1){ $count3++;$count2 = 0; foreach($driver as $row2){ $count2++; if($row2['Id_Driver']==$row['Id_Driver'] and $row2['Id_User']==$row1['Id_User']){ echo $row1['Name'];}}} ?></td>
                
               
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

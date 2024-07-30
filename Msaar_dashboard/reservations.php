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
    $Track = mysqli_query($con, "SELECT * FROM track");
    $track=array();
    while ($row = mysqli_fetch_array($Track)){
        array_push($track, $row);
        }
$Reservation = mysqli_query($con, "SELECT * FROM reservation");
$reservation=array();
     while ($row = mysqli_fetch_array($Reservation)){
        array_push($reservation, $row);
        }
$Bus = mysqli_query($con, "SELECT * FROM bus");
$bus=array();
while ($row = mysqli_fetch_array($Bus)){
    array_push($bus, $row);
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
    
        <h4 class="card-title">الحجوزات</h4>
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
              <th>رقم الحجز </th>
              <th> تاريخ البدايه </th>
                <th> تاريخ الانتهاء</th>
                <th>اسم الطالب </th>
                <th>المسار</th>
                <th>الباص</th>
                <th>الحاله</th>
                <th></th>
              </tr>
            </thead>
        <tbody>
        <?php if(!empty($reservation)){ $count = 0; foreach($reservation as $row){ $count++; ?>
            <tr>
                <td><?php echo $row['Id_Reservation']; ?></td>
                <td><?php echo $row['StartDate']; ?></td>
                <td><?php echo $row['EndDate']; ?></td>
                <td><?php $count3 = 0; foreach($user as $row1){ $count3++; $count2 = 0; foreach($student as $row2){ $count2++; if($row2['Id_User']==$row1['Id_User'] and $row2['Id_Student']==$row['Id_Student']){ echo $row1['Name'];}}} ?></td>
                <td><a href="TrackDetails.php?id=<?php echo $row['Id_Track']; ?>" ><?php echo $row['Id_Track']; ?></a></td>
                <td><a href="Bus.php?id=<?php echo $row['Id_Bus']; ?>" >  عرض الباص</a></td>
                <td><?php $count2 = 0; foreach($State as $row3){ $count2++; if($row['Id_State']==$row3['Id_State']){ echo $row3['Name'];}} ?></td>
               
            
            </tr>
            <?php } }else{ ?>
            <tr><td colspan="7">لا يوجد حجوزات مضافة</td></tr>
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

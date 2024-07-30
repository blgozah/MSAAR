<?php 
 

require_once 'dbConfig.php'; 
$Id_Bus=$_GET['id'];
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
    $Driver = mysqli_query($con, "SELECT * FROM driver");
    $driver=array();
    while ($row = mysqli_fetch_array($Driver)){
        array_push($driver, $row);
        }
        $Bus = mysqli_query($con, "SELECT * FROM bus WHERE Id_Bus=$Id_Bus");
    $bus=array();
    while ($row = mysqli_fetch_array($Bus)){
        array_push($bus, $row);
        }
  $Type = mysqli_query($con, "SELECT * FROM `bustype` ");
        $type=array();
        while ($row = mysqli_fetch_array($Type)){
            array_push($type, $row);
            }
$state= mysqli_query($con, "SELECT * FROM `state`");
    $State =array();
    while ($row = mysqli_fetch_array($state)){
    array_push($State, $row);
    }
 require_once 'header.php';
?>

    
    <!-- List the members -->
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                       
        <div class="float-right">
    
        <h4 class="card-title">تفاصيل الباص</h4>
</div>
</div>
                    </div>
                    
                    <div class="card-content">
                        <div class="card-body">
                            
    <div class="row" id="table-striped">
    <div class="table-responsive">

          <table class="table table-striped mb-0">
            <thead>
              <tr>
              <th>رقم الباص </th>
                <th>عدد الكراسي</th>
                <th>نوع الباص </th>
                <th>مسار الباص</th>
                <th>السائق</th>
                <th>الحاله</th>
                <th>صورة الباص</th>

                <th></th>
              </tr>
            </thead>
        <tbody>
        <?php if(!empty($bus)){ $count = 0; foreach($bus as $row){ $count++; ?>
            <tr>
                <td><?php echo $row['Id_Bus']; ?></td>
                <td><?php echo $row['Chair_count']; ?></td>
                <td><?php $count2 = 0; foreach($type as $row1){ $count2++; if($row['Id_Type']==$row1['Id_Type']){ echo $row1['Name'];}} ?></td>
                <td><a href="TrackDetails.php?id=<?php echo $row['Id_Track']; ?>"><?php echo $row['Id_Track']; ?></a></td>
                <td><?php $count3 = 0; foreach($user as $row1){ $count3++; $count2 = 0; foreach($driver as $row2){ $count2++; if($row2['Id_User']==$row1['Id_User'] and $row2['Id_Driver']==$row['Id_Driver']){ echo $row1['Name'];}}} ?></td>
                <td><?php $count2 = 0; foreach($State as $row3){ $count2++; if($row['Id_State']==$row3['Id_State']){ echo $row3['Name'];}} ?></td>
                <?php if(!empty($row['Image'])){?>
                <td><a href="BusImage.php?id=<?php echo $row['Id_Bus']; ?>" >  عرض الصورة</a></td>
                <?php }else{?><td>لايوجد صورة</td><?php } ?>
            </tr>
            <?php } }else{ ?>
            <tr><td colspan="7">لا يوجد باص مضاف</td></tr>
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
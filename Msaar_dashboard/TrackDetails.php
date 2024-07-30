<?php 
 

require_once 'dbConfig.php'; 
$Id_Track=$_GET['id'];
$Track = mysqli_query($con, "SELECT * FROM track WHERE Id_Track=$Id_Track");
$track=array();
while ($row = mysqli_fetch_array($Track)){
    array_push($track, $row);
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
 require_once 'header.php';
?>

    
    <!-- List the members -->
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                       
        <div class="float-right">
    
        <h4 class="card-title">تفاصيل المسار</h4>
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
              <th>رقم المسار </th>
                <th>نقطة البداية</th>
                <th>نقطة النهاية</th>
                <th>ملاحظة</th>
                <th>الحاله</th>
                
                <th></th>
              </tr>
            </thead>
        <tbody>
        <?php if(!empty($track)){ $count = 0; foreach($track as $row){ $count++; ?>
            <tr>
                <td><?php echo $row['Id_Track'];; ?></td>
                <td><?php $count2 = 0; foreach($region as $row1){ $count2++; if($row['StartIn']==$row1['Id_Region']){ echo $row1['Name'];}} ?></td>
                <td><?php $count2 = 0; foreach($region as $row2){ $count2++; if($row['EndIn']==$row2['Id_Region']){ echo $row2['Name'];}} ?></td>
                <td><?php echo $row['Note']; ?></td>
                <td><?php $count2 = 0; foreach($State as $row3){ $count2++; if($row['Id_State']==$row3['Id_State']){ echo $row3['Name'];}} ?></td>
               
                
            </tr>
            <?php } }else{ ?>
            <tr><td colspan="7">لا يوجد مسارات مضافة</td></tr>
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
<?php 
 // Include database configuration file 
require_once 'dbConfig.php'; 
 
// Start session 
require_once 'header.php';
 
// Retrieve session data 
$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:''; 
 
// Get status message from session 
if(!empty($sessData['status']['msg'])){ 
    $statusMsg = $sessData['status']['msg']; 
    $statusMsgType = $sessData['status']['type']; 
    unset($_SESSION['sessData']['status']); 
} 
$Track = mysqli_query($con, "SELECT * FROM track");
$track=array();
if (isset($_POST['submit'])) { // assuming the search term is submitted via a form
    $search_term = $_POST['search_term'];
// Build the SQL query
$sql = "SELECT * FROM track WHERE ";
$sql .= "Id_Track LIKE '%{$search_term}%' ";
// $sql .= "column2 LIKE '%{$search_term}%' OR ";
// $sql .= "column3 LIKE '%{$search_term}%' OR ";
// add more columns as needed

$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
    // Output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        array_push($track, $row);
    }
} else {
    
}}
// Fetch the data from SQL server 
else{
while ($row = mysqli_fetch_array($Track)){
    array_push($track, $row);
    }}
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

?>

    
    <!-- List the members -->
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <!-- Add link -->
        
                        <a href="addEditTrack.php" class="btn btn-primary"><i class="plus"></i>إضافة مسار</a>
                          
        <div class="float-right">
    
        <h4 class="card-title">المسارات</h4>
</div>
  
</div>

                    </div>
                    
                    <div class="card-content">
                        <div class="card-body">
                        <div class="col-md-6 mb-1">
                        <form method="post" name="search">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg></span>
                                        <input type="text" class="form-control" placeholder="... أبحث هنا" aria-label="Recipient's username" aria-describedby="button-addon2" name="search_term">
                                        <button class="btn btn-primary" type="submit" name="submit" id="button-addon2">ابحث</button>
                                    </div>
</form>
                                </div>
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
                <td><?php echo $row['Id_Track']; ?></td>
                <td><?php $count2 = 0; foreach($region as $row1){ $count2++; if($row['StartIn']==$row1['Id_Region']){ echo $row1['Name'];}} ?></td>
                <td><?php $count2 = 0; foreach($region as $row2){ $count2++; if($row['EndIn']==$row2['Id_Region']){ echo $row2['Name'];}} ?></td>
                <td><?php echo $row['Note']; ?></td>
                <td><?php $count2 = 0; foreach($State as $row3){ $count2++; if($row['Id_State']==$row3['Id_State']){ echo $row3['Name'];}} ?></td>
               
                <td>
                <a href="addEditTrack.php?id=<?php echo $row['Id_Track']; ?>" class="btn icon icon-left btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>تعديل</a>
             <?php if($row['Id_State']==2){ ?>
                    <a href="userActionTrack.php?action_type=delete&id=<?php echo $row['Id_Track']; ?>" class="btn btn-danger" onclick="return confirm('هل انت متاكد ؟');">الغاء تفعيل</a>
                    
                    <?php }else{ ?>
                        <a href="userActionTrack.php?action_type=active&id=<?php echo $row['Id_Track']; ?>" class="btn btn-success">تفعيل</a>
                        <?php } ?>
                    </td>
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

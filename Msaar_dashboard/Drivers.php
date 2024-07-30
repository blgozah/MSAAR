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
$Driver = mysqli_query($con, "SELECT * FROM driver");
$driver=array();
if (isset($_POST['submit'])) { // assuming the search term is submitted via a form
    $search_term = $_POST['search_term'];
// Build the SQL query
$sql = "SELECT * FROM driver WHERE ";
$sql .= "Id_Driver LIKE '%{$search_term}%' ";
// $sql .= "column2 LIKE '%{$search_term}%' OR ";
// $sql .= "column3 LIKE '%{$search_term}%' OR ";
// add more columns as needed

$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
    // Output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        array_push($driver, $row);
    }
} else {
    
}}
// Fetch the data from SQL server 
else{
while ($row = mysqli_fetch_array($Driver)){
    array_push($driver, $row);
    }}
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
    
        <h4 class="card-title">السائقين</h4>
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
              <th>رقم السائق </th>
              <th>اسم السائق </th>
                <th> الموقع</th>
                <th>الرقم </th>
                <th>الرخصة</th>
                <th>المسار</th>
                <th>الباص</th>
                <th>الحاله</th>
                
                <th></th>
              </tr>
            </thead>
        <tbody>
        <?php if(!empty($driver)){ $count = 0; foreach($driver as $row){ $count++; ?>
            <tr>
                <td><?php echo $row['Id_Driver']; ?></td>
                <td><?php $count2 = 0; foreach($user as $row1){ $count2++; if($row['Id_User']==$row1['Id_User']){ echo $row1['Name'];}} ?></td>
                <td><?php echo $row['Address']; ?></td>
                <td><?php echo $row['Phone']; ?></td>
                <td><a href="License.php?img=<?php echo $row['License']; ?>" >  عرض الرخصة</a></td>
                
                <?php $count2 = 0; foreach($Bus as $row1){ $count2++; if($row['Id_Driver']==$row1['Id_Driver']){  ?>
                    <td><a href="TrackDetails.php?id=<?php echo $row1['Id_Track']; ?>"><?php echo $row1['Id_Track']; ?></a></td>
                <td><a href="Bus.php?id=<?php echo $row1['Id_Bus']; }}?>">  عرض الباص</a></td>
                
                
                <td><?php $count2 = 0; foreach($State as $row3){ $count2++; if($row['Id_State']==$row3['Id_State']){ echo $row3['Name'];}} ?></td>
               
                <td>
                <?php if($row['Id_State']==2){ ?>
                    <a href="UserActionDriver.php?action_type=delete&id=<?php echo $row['Id_Driver']; ?>" class="btn btn-danger" onclick="return confirm('هل انت متاكد ؟');"> حظر</a>
                    
                    <?php }else{ ?>
                        <a href="UserActionDriver.php?action_type=active&id=<?php echo $row['Id_Driver']; ?>" class="btn btn-success">تفعيل</a>
                        <?php } ?>
                    </td>
            </tr>
            <?php } }else{ ?>
            <tr><td colspan="7">لا يوجد سائقين مضافة</td></tr>
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

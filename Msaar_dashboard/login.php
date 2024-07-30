<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول</title>
    
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    
    <link rel="stylesheet" href="assets/vendors/chartjs/Chart.min.css">

    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/Msaar-Logo1.png" type="image/x-icon">
</head>
<body>
<?php
    require('dbConfig.php');
    session_start();
    // When form submitted, check and create user session.
    if (isset($_POST['login'])) {
        $username = stripslashes($_REQUEST['Name']);    // removes backslashes
       // $username = mysqli_real_escape_string($con, $username);
        $password = stripslashes($_REQUEST['Password']);
       // $password = mysqli_real_escape_string($con, $password);
        // Check user is exist in the database
        $query    = "SELECT * FROM `user` WHERE `Name`='$username'
                     AND `Password`='$password'";
        $result = mysqli_query($con, $query) or die(mysql_error());
        $rows = mysqli_num_rows($result);
        $row = mysqli_fetch_array($result);
        if ($rows == 1) {
            $Id_User=$row['Id_User'];
            $query2   = "SELECT Id_Admin FROM `admin` WHERE `Id_User`='$Id_User'";
                     $result2 = mysqli_query($con, $query2) or die(mysql_error());
                     
                     $row2= mysqli_fetch_array($result2);
            $_SESSION['username'] = $username;
            $_SESSION['Id_User']=$Id_User;
            $_SESSION['Id_Admin'] =$row2['Id_Admin'] ;
            // Redirect to user dashboard page
            header("Location: tracks.php");
        } else {
            echo "<div class='form'>
                  <h3>Incorrect Username/password.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
                  </div>";
        }
    } else {
?>
    <div id="auth">
        
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-sm-12 mx-auto">
                    <div class="card pt-4">
                        <div class="card-body">
                            <div class="text-center mb-5">
                                <img src="assets/images/Msaar-Logo1.png" height="48" class='mb-4'>
                                <h3>تسجيل الدخول</h3>
                                
                            </div>
                            <form method="post" name="login">
                                <div class="form-group position-relative has-icon-left">
                                    <label for="Name">اسم المستخدم</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" id="Name" name="Name">
                                        <div class="form-control-icon">
                                            <i data-feather="user"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group position-relative has-icon-left">
                                    <div class="clearfix">
                                        <label for="Password">الرقم السري</label>
                                        
                                    </div>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" id="Password" name="Password">
                                        <div class="form-control-icon">
                                            <i data-feather="lock"></i>
                                        </div>
                                    </div>
                                </div>
        
                                
                                <div class="clearfix">
                                <input type="submit" value="تسجيل الدخول" name="login" class="btn btn-primary float-right"/>

                                </div>
                            </form>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
            </div>
            <?php }?>
            <script src="assets/js/feather-icons/feather.min.js"></script>
            <script src="assets/js/app.js"></script>
            
            <script src="assets/js/main.js"></script>
        </body>
        
        </html>
        
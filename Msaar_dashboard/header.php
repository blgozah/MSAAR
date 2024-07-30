<?php include("auth_session.php");
$AdminName=$_SESSION["username"];
$AdminId=$_SESSION["Id_Admin"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة تحكم مسار</title>
    
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    
    <link rel="stylesheet" href="assets/vendors/chartjs/Chart.min.css">

    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/Msaar-Logo1.png" type="image/x-icon">
    
</head>
<body>
    <div id="app">
        <div id="sidebar" class='active'>
            <div class="sidebar-wrapper active">
    <div class="sidebar-header">
        <img src="assets/images/Msaar-Logo1.png" alt="" srcset="">
    </div>
    <div class="sidebar-menu">
        <ul class="menu">
            
            
                <li class='sidebar-title'>القائمة الرئيسية</li>
            
            
            
                <li class="sidebar-item">
                    <a href="index.php" class='sidebar-link'>
                        <i data-feather="home" width="20"></i> 
                        <span>الرئيسية </span>
                    </a>
                    
                </li>

            
            
            
                <li class="sidebar-item ">
                    <a href="tracks.php" class='sidebar-link'>
                        <i data-feather="triangle" width="20"></i> 
                        <span>المسارات</span>
                    </a>
                     
                </li>

            
            
            
                <li class="sidebar-item ">
                    <a href="regions.php" class='sidebar-link'>
                        <i data-feather="briefcase" width="20"></i> 
                        <span>المناطق</span>
                    </a>
                    
                   
                </li>

            
            
                <li class="sidebar-item ">
                    <a href="BusStation.php" class='sidebar-link'>
                        <i data-feather="file-text" width="20"></i> 
                        <span>المحطات</span>
                    </a>
                    
                </li>

            
            
            
                <li class="sidebar-item  ">
                    <a href="Drivers.php" class='sidebar-link'>
                        <i data-feather="layout" width="20"></i> 
                        <span>السائقين</span>
                    </a>
                    
                </li>

            
            
            
                <li class="sidebar-item  ">
                    <a href="Students.php" class='sidebar-link'>
                        <i data-feather="layers" width="20"></i> 
                        <span>الطلاب</span>
                    </a>
                    
                </li>

            
            
            
                <li class="sidebar-item  ">
                    <a href="colleges.php" class='sidebar-link'>
                        <i data-feather="grid" width="20"></i> 
                        <span>الكليات</span>
                    </a>
                    
                </li>

            
            
            
                <li class="sidebar-item  ">
                    <a href="reservations.php" class='sidebar-link'>
                        <i data-feather="file-plus" width="20"></i> 
                        <span>الحجوزات</span>
                    </a>
                    
                </li>
            
                <li class="sidebar-item ">
                    <a href="viweLostThing.php" class='sidebar-link'>
                        <i data-feather="triangle" width="20"></i> 
                        <span>المفقودات</span>
                    </a>
                     
                </li>
            
                <li class="sidebar-item ">
                    <a href="Cards.php" class='sidebar-link'>
                        <i data-feather="user" width="20"></i> 
                        <span>كروت الرصيد</span>
                    </a>
                    
                </li>

            
            
                
            
            
            
                <li class="sidebar-item ">
                    <a href="Complaints.php" class='sidebar-link'>
                        <i data-feather="user" width="20"></i> 
                        <span>الشكاوي</span>
                    </a>
                    
                </li>

            
            
         
        </ul>
    </div>
    <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
</div>
        </div>
        <div id="main">
            <nav class="navbar navbar-header navbar-expand navbar-light">
                <a class="sidebar-toggler" href="#"><span class="navbar-toggler-icon"></span></a>
                <button class="btn navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav d-flex align-items-center navbar-light ml-auto">
                       
                        
                        <li class="dropdown">
                            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                                
                                <div class="d-none d-md-block d-lg-inline-block"><?php echo $AdminName ?></div>
                               
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="AdminInfo.php"><i data-feather="user"></i> حسابي</a>
    
                                <a class="dropdown-item" href="logout.php"><i data-feather="log-out"></i> تسجيل خروج</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
          
<?php
require_once 'header.php';
require_once 'dbConfig.php'; 
?>
<?php
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
    $Requst = mysqli_query($con, "SELECT * FROM requst");
$requst=array();
while ($row = mysqli_fetch_array($Requst)){
    array_push($requst, $row);
    }
$result = mysqli_query($con, "SELECT Id_Region, COUNT(*) AS num_students FROM student GROUP BY Id_Region");

// Define an array of colors for the pie chart

// Initialize the values array
$values = array();
$lable=array();
// Loop through the results and add the values to the array
while ($row = mysqli_fetch_assoc($result)) {
  $id_region = $row['Id_Region'];
  $num_students = $row['num_students'];
  
  // Retrieve the region name from the regions table
  $region_result = mysqli_query($con, "SELECT `Name` FROM region WHERE Id_Region = $id_region");
  $region_row = mysqli_fetch_assoc($region_result);
  $region_name = $region_row['Name'];
  
  // Add the region name and number of students to the values array
  $values[] = $num_students;
  $lable[]=$region_name;
}
// Get the current month
$current_month = date('m');

// Get the last month
$last_month = date('m', strtotime('-1 month'));
$numStudent = mysqli_query($con, "SELECT MONTH(StartDate) AS month, SUM(Id_Student) AS total_students FROM reservation GROUP BY MONTH(StartDate)");
$num=array();
while ($row = mysqli_fetch_array($numStudent)){
    array_push($num, $row);
    }
foreach($num as $row){

$month[]=$row['month'];
$student[]=$row['total_students'];
    if ($row['month']==$current_month){
        $numofnow=$row['total_students'];
    }
   elseif($row['month']==$last_month){
        $numoflast=$row['total_students'];
    }
};

?>
 <head>
    
    <style type="text/css">      
      html, body, #container { 
        width: 100%; height: 100%; margin: 0; padding: 0; 
      } 
    </style>
  </head>
<body>
<div class="row mb-4">
                <div class="col-md-8">
    </br>
    </br>
    </br>
    </br>

                <div class="card">

<div class="card-header">
    <h3 class="card-heading p-1 pl-3">الاشتراكات</h3>
</div>
<div class="card-body">
    <div class="row">
    <div class="col-md-8 col-12"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
            <canvas id="bar1222" style="display: block; height: 311px; width: 622px;" width="933" height="466" class="chartjs-render-monitor"></canvas>
        </div>
        <div class="col-md-4 col-12">
            <div class="pl-3">
                <h1 class="mt-5">عدد الاشتراكات</h1>
                
                <div class="legends">
                    <div class="legend d-flex flex-row align-items-center">
                        <div class="w-3 h-3 rounded-full bg-gray mr-2"></div><span class="text-xs">في هذا الشهر :<?php echo $numofnow?> </span>
                    </div>
                    <div class="legend d-flex flex-row align-items-center">
                        <div class="w-3 h-3 rounded-full bg-black mr-2"></div><span class="text-xs">في الشهر الماضي :<?php echo $numoflast?> </span>
                    </div>
                </div>
            </div>
        </div>
       
    </div>
</div>
</div>
</div>


                    <div class="col-md-4">
                    <div class="card ">
                        <div class="card-header">
                            <h4>عدد الطلاب بالنسبة للمناطق</h4>
                        </div>
                        <div class="card-body" style="position: relative;">
                        <canvas id="myCanvas" width="300" height="300"></canvas>
                        </div>
                    </div>
                </div>
                
                </div>
                
                <div class="card">

<div class="card-header">
    <h3 class="card-heading p-1 pl-3">الاشتراكات</h3>
</div>
<div class="card-body">
    <div class="row">
    

    <div class="row" id="table-striped">
    <div class="table-responsive">

          <table class="table table-striped mb-0">
            <thead>
              <tr>
              <th>نوع الطلب</th>
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
        <?php if(!empty($requst)){ $count6 = 0; foreach($requst as $row6){ $count6++;$count = 0; foreach($driver as $row){ $count++;if($row6['Id_Driver']==$row['Id_Driver']){ ?>
            <tr>
            <td><?php if($row6['Type']==0){
                echo "الغاء تفعيل";
            }else{
                echo"تحقق و تفعيل ";
            }?></td>
                <td><?php echo $row['Id_Driver']; ?></td>
                <td><?php $count2 = 0; foreach($user as $row1){ $count2++; if($row['Id_User']==$row1['Id_User']){ echo $row1['Name'];}} ?></td>
                <td><?php echo $row['Address']; ?></td>
                <td><?php echo $row['Phone']; ?></td>
                <td><a href="License.php?img=<?php echo $row['License']; ?>" >  عرض الرخصة</a></td>
                
                <?php $count2 = 0; foreach($Bus as $row1){ $count2++; if($row['Id_Driver']==$row1['Id_Driver']){  ?>
                    <td><a href="TrackDetails.php?id=<?php echo $row1['Id_Track']; ?>"><?php echo $row1['Id_Track']; ?></a></td>
                <td><a href="Bus.php?id=<?php echo $row1['Id_Bus']; }}?>">  عرض الباص</a></td>
                
                

               
                <td>
                <?php if($row['Id_State']==2){ ?>
                    <a href="UserActionDriver.php?action_type=unactive&id=<?php echo $row['Id_Driver']; ?>" class="btn btn-danger" onclick="return confirm('هل انت متاكد ؟');"> إلغاء التفعيل</a>
                    
                    <?php }elseif($row['Id_State']==1){ ?>
                        <a href="UserActionDriver.php?action_type=active&id=<?php echo $row['Id_Driver']; ?>" class="btn btn-success">تفعيل</a>
                        <?php } ?>
                    </td>
            </tr>
            <?php } }}}else{ ?>
            <tr><td colspan="7">لا يوجد سائقين مضافة</td></tr>
            <?php } ?>
        </tbody>
    
    </table>
</div>
            </div>
       
    
</div>
</div>
            </div>            
                </div>
                    
               
                
            
<?php
require_once 'footer.php';
?>
</html>
<script type="text/javascript">
		
		var obj = {
						values: <?php echo json_encode($values) ?>,
                        label: <?php echo json_encode($lable) ?>,
						colors: ['#00FFFF', '#6495ED', '#BCE6FF', '#4682B4', '#3245D1'],
						animation: true, // Takes boolean value & default behavious is false
						animationSpeed: 50, // Time in miliisecond & default animation speed is 20ms
						fillTextData: true, // Takes boolean value & text is not generate by default 
						fillTextColor: '#fff', // For Text colour & default colour is #fff (White)
						fillTextAlign: 1.30, // for alignment of inner text position i.e. higher values gives closer view to center & default text alignment is 1.85 i.e closer to center
						fillTextPosition: 'inner', // 'horizontal' or 'vertical' or 'inner' & default text position is 'horizontal' position i.e. outside the canvas
						doughnutHoleSize: 50, // Percentage of doughnut size within the canvas & default doughnut size is null
						doughnutHoleColor: '#fff', // For doughnut colour & default colour is #fff (White)
						offset: 1, // Offeset between two segments & default value is null
						pie: 'normal', // if the pie graph is single stroke then we will add the object key as "stroke" & default is normal as simple as pie graph
						isStrokePie: { 
							stroke: 20, // Define the stroke of pie graph. It takes number value & default value is 20
							overlayStroke: true, // Define the background stroke within pie graph. It takes boolean value & default value is false
							overlayStrokeColor: '#eee', // Define the background stroke colour within pie graph & default value is #eee (Grey)
							strokeStartEndPoints: 'Yes', // Define the start and end point of pie graph & default value is No
							strokeAnimation: true, // Used for animation. It takes boolean value & default value is true
							strokeAnimationSpeed: 40, // Used for animation speed in miliisecond. It takes number & default value is 20ms
							fontSize: '60px', // Used to define text font size & default value is 60px
							textAlignement: 'center', // Used for position of text within the pie graph & default value is 'center'
							fontFamily: 'Arial', // Define the text font family & the default value is 'Arial'
							fontWeight: 'bold' //  Define the font weight of the text & the default value is 'bold'
						}
					  };
		
		
		//Generate myCanvas		
		// generatePieGraph('myCanvas', obj);
		
		
		
		
	</script>
<script>
    var chartColors = {
  red: 'rgb(255, 99, 132)',
  orange: 'rgb(255, 159, 64)',
  yellow: 'rgb(255, 205, 86)',
  green: 'rgb(75, 192, 192)',
  info: '#41B1F9',
  blue: '#3245D1',
  purple: 'rgb(153, 102, 255)',
  grey: '#BOC4DE',
  blue1:'#B0E0E6',
  blue2:'#1E90FF',
  blue3:'#87CEFA',
  blue4:'#4682B4',
  blue5:'#87CEEB',
  blue6:'#AFEEEE',
  blue7:'#00CED1',
  blue8:'#00FFFF',
  blue9:'#6495ED',
  blue10:'#ADD8E6',
  blue11:'#BCE6FF',
  blue12:'#88CDF6',
};

var ctxBar = document.getElementById("bar1222").getContext("2d");;
var myBar = new Chart(ctxBar, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($month) ?>,
        datasets: [{
            label: 'الطلاب',
            backgroundColor: [chartColors.blue1, chartColors.blue2, chartColors.blue3,chartColors.blue4, chartColors.blue5, chartColors.blue6,chartColors.blue7, chartColors.blue8, chartColors.blue9,chartColors.blue10, chartColors.blue11, chartColors.blue12],
             data: <?php echo json_encode($student) ?>,
        }]
    },
    options: {
        responsive: true,
        barRoundness: 1,
        title: {
            display: true,
            text: "Students in 2020"
        },
        legend: {
            display: false
        },
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true,
                    suggestedMax: 40 + 20,
                    padding: 10,
                },
                gridLines: {
                    drawBorder: false,
                }
            }],
            xAxes: [{
                gridLines: {
                    display: false,
                    drawBorder: false
                }
            }]
        }
    }
});
var ctx = document.getElementById("myCanvas").getContext("2d");;
var my = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: <?php echo json_encode($lable) ?>,
        datasets: [{
            label: "الطلاب",
            data: <?php echo json_encode($values) ?>,
            backgroundColor: [chartColors.blue1, chartColors.blue2, chartColors.blue3,chartColors.blue4, chartColors.blue5, chartColors.blue6,chartColors.blue7, chartColors.blue8, chartColors.blue9,chartColors.blue10, chartColors.blue11, chartColors.blue12],
            borderColor: [chartColors.blue1, chartColors.blue2, chartColors.blue3,chartColors.blue4, chartColors.blue5, chartColors.blue6,chartColors.blue7, chartColors.blue8, chartColors.blue9,chartColors.blue10, chartColors.blue11, chartColors.blue12],
            borderWidth: 1
        }]
    },
    options: {
      
				title: {
					display: true,
					text: "This is your 401(k) account's current asset mix"
				},
      animation: {
					animateScale: true,
					animateRotate: true
				},
      responsive: true,
      maintainAspectRatio: false,
        
      legend: {
					position: 'right',
        labels:{
          boxWidth: 10,
          padding: 12
        }
				},
    }
});
</script>
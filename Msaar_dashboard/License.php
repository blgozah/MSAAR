<?php 
 

require_once 'dbConfig.php'; 
$img=$_GET['img'];

       

 require_once 'header.php';
?>

    
    <!-- List the members -->
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                       
        <div class="float-right">
    
        <h4 class="card-title">صورة الرخصة</h4>
</div>
</div>
                    </div>
                    
                    <div class="card-content">
                        <div class="card-body">
                            
    <div class="row" id="table-striped">
    <div class="table-responsive">

    <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <h4 class="card-title">صورة الرخصة</h4>
                        </div>
                        <img class="card-img" src="assets/images/License/<?php echo $img;?>">
                    </div>
                </div>
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
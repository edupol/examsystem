<?php 
    
    include_once('include/header.php'); 
    include_once('include/training_course.php');
?>
<div class="ch-container">
    <div class="row">
        

    <?php 

        include_once('include/leftmenu1.php');
    ?>
        <noscript>
            <div class="alert alert-block col-md-12">
                <h4 class="alert-heading">Warning!</h4>

                <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a>
                    enabled to use this site.</p>
            </div>
        </noscript>

<div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->
            

<div>
    <ul class="breadcrumb">
        <li>
            <a href="#">Home</a>
        </li>
        <li>
            <a href="#">Blank</a>
        </li>
    </ul>
</div>

<div class="row">
    <form id="examSubmit" action="" method="POST">
    <div class="box col-md-12" >
        <div class="box-inner">
            <div class="box-header fixbox well fixbox" data-original-title="">
                <h2 class="fix-head-text col-sm-12" id="examBox"><i class="glyphicon glyphicon-star-empty "></i><span class="customFont1 fix-font1">ปรับปรุงชื่อหลักสูตร</span></h2> 
            </div>
            <div class="clearfix"></div>        
            <div id="examDescription" class="box-content">
                <!-- put your content here -->  
                <div class="form-group col-xs-6 col-sm-6 col-md-6">
                    <label for="short_name">ชื่อย่อหลักสูตร</label>
                    <input type="text" class="form-control assignment-date customFont0 fix-font1" id="shortName" name="short_name" value=""  placeholder="ระบุชื่อย่อหลักสูตร">
                </div>   
                <div class="clearfix"></div>

                <div class="form-group col-xs-6 col-sm-6 col-md-6">
                    <label for="full_name">ชื่อหลักสูตร</label>
                    <input type="text" class="form-control assignment-date customFont0 fix-font1" id="fullName" name="full_name" value="" placeholder="ระบุชื่อหลักสูตร">
                </div>                       
            </div>
            <div class="clearfix"></div>

            <div class="col-md-4 col-sm-6 col-xs-6" style="padding-top:25px">
                <a id="save" class="btn btn-info customFont0"  href="#" data-toggle="tooltip" data-original-title="กดปุ่มเพื่อบันทึกข้อมูล">
                    <i class="glyphicon glyphicon-ok-sign glyphicon-white"></i> 
                    บันทึกข้อมูล                                                        
                </a> 
                <input name="user_id" type="hidden" value="" />
            </div>
        </div>
    </div>          

    </form>
</div><!--/row-->


    <!-- content ends -->
    </div><!--/#content.col-md-0-->
</div><!--/fluid-row-->


<?php 

    include_once('include/footer.php'); 

?>

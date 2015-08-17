<?php 
    
    include_once('include/header.php'); 

?>
<div class="ch-container tour">
    <div class="row">
        

    <?php 

        include_once('include/leftmenu1.php');
    ?>
        <noscript>
            <div class="alert alert-block col-md-12">
                <h4 class="alert-heading">Warning!</h4>

                <p>You need to localhave <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a>
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
            <a href="#">กำหนดรายชื่อผู้เข้าทดสอบ</a>
        </li>
    </ul>
</div>

<div class="row">
    <form id="examSubmit" action="" method="POST">
    <div class="box col-md-12" >
        <div class="box-inner">
            <div class="box-header fixbox well fixbox" data-original-title="">
                <h2 class="fix-head-text col-sm-12" id="examBox"><i class="glyphicon glyphicon-star-empty "></i><span class="customFont1 fix-font1">กำหนดวัน-เวลา การทดสอบ</span></h2> 
            </div>
            <div class="clearfix"></div>        
            <div id="examDescription" class="box-content">
                <!-- put your content here -->  
                <div class="form-group col-xs-6 col-sm-6 col-md-6">
                    <label for="startAssignment">วันเริ่มต้นทำแบบทดสอบ</label>
                    <input type="text" class="form-control assignment-date customFont0 fix-font1" id="startAssignment" name="startAssignment" value=""  placeholder="ระบุวันที่เริ่มต้นการทำทดสอบ">
                </div>   
                <div class="form-group col-xs-6 col-sm-6 col-md-6">
                    <label for="endAssignment">วันสุดท้ายของการทำแบบทดสอบ</label>
                    <input type="text" class="form-control assignment-date customFont0 fix-font1" id="endAssignment" name="endAssignment" value="" placeholder="ระบุวันสิ้นสุดการทำแบบทดสอบ">
                </div>                       
            </div>
            <div class="clearfix"></div>



        </div>
    </div>          

    </form>
    <div class="clearfix"></div>
    <div class="box col-md-12" >
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2 id="addExamBox"><i class="glyphicon glyphicon-star-empty"></i><span class="customFont1 fix-font1" >เลือกหลักสูตรที่ต้องการจัดสอบ</span></h2>
            </div>
            <div class="box-content">
                <!-- put your content here -->
                <div class="row">

                    <!-- Exam group -->
                    <div class="col-md-4 col-sm-6 col-xs-6">
                        <a href="#" class="well top-block" title="" data-toggle="tooltip" data-original-title="เลือกสถานที่">
                            <i class="glyphicon glyphicon-th-large blue"></i>
                            <div>
                                สถานที่
                            </div>
                            <div>
                                <select id="trainingplace" name="trainingplace" data-rel="chosen" class="form-control input-lm "></select>
                            </div>

                            <span id="totalPlace" class="notification customFont0 fix-font1 red">0</span>
                        </a>
                    </div>

                    <!-- Exam group -->
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <a href="#" class="well top-block" title="" data-toggle="tooltip" data-original-title="เลือกหลักสูตร">
                            <i class="glyphicon glyphicon-book blue"></i>
                            <div>
                                หลักสูตรการฝึกอบรม
                            </div>
                            <div>
                                <select id="trainingcourse" name="trainingcourse" data-rel="chosen" class="form-control input-lm"></select>
                            </div>

                            <span id="totalCourse" class="notification customFont0 fix-font1 red">0</span>
                        </a>
                    </div>

                    <!-- Exam subject -->
                    <div class="col-md-2 col-sm-6 col-xs-6">
                        <a href="#" class="well top-block" title="" data-toggle="tooltip" data-original-title="เลือกวิชาที่ต้องการออกข้อสอบ">
                            <i class="glyphicon glyphicon-list-alt blue"></i>
                            <div>
                                รุ่นที่
                            </div>
                            <div>
                                <select id="coursenumber" name="coursenumber" data-rel="chosen" class="form-control input-lm "></select>
                            </div>

                            <span id="totalNum" class="notification red customFont0 fix-font1">0</span>
                        </a>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-4 col-sm-6 col-xs-6" style="padding-top:25px">
                        
                        <a id="addExam" class="btn btn-primary btn-md customFont0 fix-font1" href="#"><i class="glyphicon glyphicon-plus glyphicon-white"></i> เพิ่มรายชื่อผู้เข้ารับการทดสอบ</a>    
                    </div>

                </div>
            </div>
        </div>
    </div>


    <div class="box col-md-12" id="addNums">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-star-empty"></i><span class="customFont1 fix-font1"> รายชื่อหลักสูตร</span></h2>
            </div>
            <div id="AssignmentContainer" class="box-content">
                <!-- put your content here -->
            </div>
            <div class="clearfix"></div>
            <div class="box-content">
                <!-- put your content here -->
                <label>รวมจำนวน</label>
                <label id="totalQuestions">0</label>
                <label>หลักสูตร</label>
            </div>

        </div>
    </div>
    <div class="clearfix"></div>

    <div class="col-md-4 col-sm-6 col-xs-6" style="padding-top:25px">

            <a id="save" class="btn btn-info customFont0"  href="#" data-toggle="tooltip" data-original-title="กดปุ่มเพื่อบันทึกข้อมูล">
                <i class="glyphicon glyphicon-refresh glyphicon-white"></i> 
                บันทึกข้อมูล                                                        
            </a> 
                  
            <input name="assign_by" type="hidden" value="<?php echo $_POST['user_id'];?>" />
            <input name="exam_random_history_id" type="hidden" value="<?php echo $_POST['exam_id'];?>" />
        
    </div>

</div><!--/row-->


    <!-- content ends -->
    </div><!--/#content.col-md-0-->
</div><!--/fluid-row-->

<?php 

    include_once('include/footer.php'); 

?>

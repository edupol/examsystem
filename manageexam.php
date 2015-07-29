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
            <a href="#">ออกข้อสอบ</a>
        </li>
    </ul>
</div>

<div class="row">

    <div class="box col-md-12" >
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <span class="customFont1" id="addExamBox"><i class="glyphicon glyphicon-star-empty"></i> เพิ่มวิชาออกสอบ</span>
            </div>
            <div class="box-content">
                <!-- put your content here -->
                <div class="row">

                    <!-- Exam group -->
                    <div class="col-md-4 col-sm-6 col-xs-6">
                        <a href="#" class="well top-block" title="" data-toggle="tooltip" data-original-title="เลือกหลักสูตร">
                            <i class="glyphicon glyphicon-book blue"></i>
                            <div class="customFont1">
                                หลักสูตร
                            </div>
                            <div>
                                <select id="examcourse" name="examcourse" data-rel="chosen" class="form-control input-lm"></select>
                            </div>

                            <span id="totalCourse" class="notification">0</span>
                        </a>
                    </div>

                    <!-- Exam group -->
                    <div class="col-md-4 col-sm-6 col-xs-6">
                        <a href="#" class="well top-block" title="" data-toggle="tooltip" data-original-title="เลือกกลุ่มวิชา">
                            <i class="glyphicon glyphicon-th-large blue"></i>
                            <div class="customFont1">
                                กลุ่มวิชา
                            </div>
                            <div>
                                <select id="examgroup" name="examgroup" data-rel="chosen" class="form-control input-lm"></select>
                            </div>

                            <span id="totalGroup" class="notification">0</span>
                        </a>
                    </div>

                    <!-- Exam subject -->
                    <div class="col-md-4 col-sm-6 col-xs-6">
                        <a href="#" class="well top-block" title="" data-toggle="tooltip" data-original-title="เลือกวิชาที่ต้องการออกข้อสอบ">
                            <i class="glyphicon glyphicon-list-alt blue"></i>
                            <div class="customFont1">
                                วิชา
                            </div>
                            <div>
                                <select id="exams" name="exams" data-rel="chosen" class="form-control input-lm"></select>
                            </div>

                            <span id="totalExam" class="notification red">0</span>
                        </a>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-4 col-sm-6 col-xs-6" style="padding-top:25px">
                        
                        <a id="addExam" class="btn btn-primary btn-md customFont0" href="#"><i class="glyphicon glyphicon-plus glyphicon-white"></i> เพิ่มวิชาลงในข้อสอบ</a>    
                    </div>

                </div>
            </div>
        </div>
    </div>


    <div class="box col-md-12" id="addNums">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <span class="customFont1"><i class="glyphicon glyphicon-star-empty"></i> กำหนดจำนวนข้อของแต่ละวิชา</span>
            </div>
            <div id="ExamsContainer" class="box-content">
                <!-- put your content here -->
            </div>
            <div class="clearfix"></div>
            <div class="box-content">
                <!-- put your content here -->
                <label>รวมจำนวนข้อสอบ</label>
                <label id="totalQuestions">0</label>
                <label>ข้อ</label>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-6" style="padding-top:25px">
                <a id="randomExam" class="btn btn-primary btn-md customFont0"  href="#" data-toggle="tooltip" data-original-title="สามารถสุ่มซ้ำได้">
                    <i class="glyphicon glyphicon-refresh glyphicon-white"></i> 
                    สุ่มข้อสอบ
                </a>    
            </div>
        </div>
    </div>
    <div class="clearfix"></div>

    <form id="examSubmit" action="export_word.php" method="POST">   
    <div class="box col-md-12" >
        <div class="box-inner">
            <div class="box-header fixbox well fixbox" data-original-title="">
                <span class="customFont1 fix-head-text col-sm-12" id="examBox"><i class="glyphicon glyphicon-star-empty"></i> ข้อสอบ</span> 
                


            </div>
            <div class="clearfix"></div>        
            <div id="QuestionsContainer" class="box-content">
                <!-- put your content here -->          
            </div>
            <div class="clearfix"></div>

        </div>
    </div>    

    <div class="clearfix"> </div>
    
    <div class="box col-md-12" >
        <div class="box-inner">
            <div class="box-header fixbox well fixbox" data-original-title="">
                <span class="customFont1 fix-head-text col-sm-12" id="examBox"><i class="glyphicon glyphicon-star-empty"></i>รายละเอียดข้อสอบ</span> 
            </div>
            <div class="clearfix"></div>        
            <div id="examDescription" class="box-content">
                <!-- put your content here -->  
                <div class="form-group col-xs-6 col-sm-6 col-md-6">
                    <label for="examName">ชื่อชุดข้อสอบ</label>
                    <input type="text" class="form-control" id="examName" name="name" value=""  placeholder="ระบุชื่อชุดข้อสอบ">
                </div>   
                <div class="form-group col-xs-6 col-sm-6 col-md-6">
                    <label for="examMinute">เวลา (นาที)</label>
                    <input type="text" class="form-control" id="examMinute" name="exam_minute" value="60" maxlength="3" placeholder="ระบุจำนวนเวลาที่ใช้ในการทำแบบทดสอบ">
                </div>                       
            </div>
            <div class="clearfix"></div>

            <div class="col-md-4 col-sm-6 col-xs-6" style="padding-top:25px">

                    <a id="exportDocument" class="btn btn-primary btn-md customFont0"  href="#">
                        <i class="glyphicon glyphicon-download glyphicon-white"></i> 
                        ดาว์นโหลดข้อสอบ
                    </a>    
                    <input name="questions_id" id="questions_id" type="hidden" />
                    <input name="random_questions" id="randomQuestions" type="hidden" />
                    <input name="user_id" id="uid" type="hidden" />
                
            </div>

        </div>
    </div>      

    </form>

    <div class="clearfix"></div>

</div><!--/row-->


    <!-- content ends -->
    </div><!--/#content.col-md-0-->
</div><!--/fluid-row-->

<?php 

    include_once('include/footer.php'); 

?>

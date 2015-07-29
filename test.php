<?php 
    
    include_once('include/header.php'); 

?>
<div class="ch-container">
    <div class="row">
        

    <?php 

        //include_once('include/leftmenu1.php');
    ?>
        <noscript>
            <div class="alert alert-block col-md-12">
                <h4 class="alert-heading">Warning!</h4>

                <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a>
                    enabled to use this site.</p>
            </div>
        </noscript>

<div id="content" class="col-lg-12 col-sm-12">
            <!-- content starts -->
            <div>
                <ul class="breadcrumb">
                    <li>
                        <a href="#">Home</a>
                    </li>
                    <li>
                        <a href="#">ระบบทดสอบความรู้</a>
                    </li>
                </ul>

                <div class="box ">
                    <div class="col-md-3"><span class="label1">ผู้เข้าทดสอบ</span><span class="exam-text">xxxxxxxx</span></div>
                    <div class="col-md-2"><span class="label1">ตำแหน่ง</span><span class="exam-text">xxxxxxxx</span></div>
                    <div class="col-md-2"><span class="label1">จำนวนข้อ</span><span class="exam-text">xxxxxxxx</span></div>                    
                    <div class="col-md-5"><span class="label1">ชื่อแบบทดสอบ</span><span class="exam-text">xxxxxxxx</span></div>
                </div>
                <div class="box ">
                    <div class="col-md-3"><span>เวลาทำข้อสอบ</span><span id="StartClock" class="exam-text">xxxxxxxx</span></div>
                    <div class="col-md-2"><span>ใช้เวลาไป</span><span id="StartClock" class="exam-text">xxxxxxxx</span></div>
                    <div class="col-md-3"><span>เหลือเวลา</span><span id="EndClock"  class="exam-text">xxxxxxxx</span></div>
                </div>                
            </div>
            <form id="answers">
                <div class="row">
                    <div class="box col-md-12">
                        <div class="box-inner">
                            <div class="box-header well" data-original-title="">
                                <h2><i class="glyphicon glyphicon-star-empty"></i> ระบบทดสอบความรู้</h2>
                            </div>
                            <div id="examContainer" class="box-content">
                                <!-- put your content here -->

                            </div>
                        </div>
                    </div>
                </div><!--/row-->


                    <!-- content ends -->
                    </div><!--/#content.col-md-0-->
                </div><!--/fluid-row-->

                <div class="clearfix form-group"></div>
                <!--End control group-->
       
                <div class="form-actions form-group">
                    <a id="saveAnswer" class="btn btn-success"><i class=" icon-ok icon-white"></i> บันทึกค่า</a>
                    <a class="btn btn-primary" href="login.html">
                        <i class="icon-home icon-white"></i> 
                        ยกเลิก
                    </a>
                </div>                
            </form>

<?php 

    include_once('include/footer.php'); 

?>

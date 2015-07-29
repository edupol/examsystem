<?php 
    
    include_once('include/header.php'); 

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
            <a href="#">Change Password </a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner" id="changepwd">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-star-empty"></i> เปลี่ยนรหัสผ่าน</h2>
            </div>
            <div class="box-content">
                <!-- put your content here -->
                <form id="Register">
                    <div class="form-group">
                        <label class="control-label" for="first_name">รหัสผ่านเดิม</label> 
                        <div class="clearfix"></div>
                        <input placeholder="รหัสผ่านเดิม" name="password" class="form-control input-lm" type="password" value="" maxlength="50">                                      
                                             

                    </div>
                    <div class="clearfix"></div>                
                    <!--End control group-->

                    <div class="form-group">
                        <label class="control-label" for="first_name">รหัสผ่านใหม่</label> 
                        <div class="clearfix"></div>
                        <input placeholder="รหัสผ่านใหม่" name="new_password" class="form-control input-lm" type="password" value="" maxlength="50">                                      
                                             

                    </div>
                    <div class="clearfix"></div>                
                    <!--End control group-->

                    <div class="form-group">
                        <label class="control-label" for="first_name">ยืนยันรหัสใหม่</label> 
                        <div class="clearfix"></div>
                        <input placeholder="ยืนยันรหัสใหม่" name="confirm_password" class="form-control input-lm" type="password" value="" maxlength="50">                                      
                                             

                    </div>
                    <div class="clearfix"></div>                
                    <!--End control group--> 

                    <div class="control-group">
                        <a class="save btn btn-success"><i class=" icon-ok icon-white"></i> บันทึกค่า</a>
                        <a class="btn btn-primary" href="login.html">
                            <i class="icon-home icon-white"></i> 
                            กลับสู่หน้าหลัก
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div><!--/row-->


    <!-- content ends -->
    </div><!--/#content.col-md-0-->
</div><!--/fluid-row-->


<?php 

    include_once('include/footer.php'); 

?>

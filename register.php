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
            <a href="#">Registration</a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-star-empty"></i> ลงทะเบียน</h2>


            </div>
            <div class="box-content">


                <form id="Register">

                <div class="control-group row">
                    <label class="control-label col-xs-6 col-sm-6 col-md-6" for="first_name">ชื่อบัญชีผู้ใช้ </label> 
                    <div class="clearfix"></div>
                    <div class="col-xs-4 col-sm-4 col-md-4">
                        <input placeholder="โปรดระบุชื่อผู้ใช้" id="username" name="username" class="form-control input-lm" type="text" value="" maxlength="255">                                      
                    </div>     

                    <span id="user-result"></span>                
                </div>
                <div class="clearfix"></div>                
                <!--End control group-->

                <!-- put your content here -->
                <div class="control-group row">
                    <label class="control-label col-xs-6 col-sm-6 col-md-6" for="rank">คำนำหน้าชื่อ/ยศ</label>
                    <div class="clearfix"></div>
                    <div class="controls col-xs-6 col-sm-6 col-md-6">
                        <select id="rank" name="rank" data-rel="chosen" class="form-control input-lm">

                        </select>
                    </div>

                </div>
                <div class="clearfix"></div>
                <!--End control group-->

                <div class="control-group row">
                    <label class="control-label col-xs-6 col-sm-6 col-md-6" for="first_name">ชื่อ</label> 
                    <div class="clearfix"></div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <input placeholder="โปรดระบุชื่อ" name="first_name" class="form-control input-lm" type="text" value="" maxlength="255">                                      
                    </div>                     
                </div>
                <div class="clearfix"></div>                
                <!--End control group-->

                <div class="control-group row">
                    <label for="last_name" class="control-label col-xs-6 col-sm-6 col-md-6">นามสกุล</label>     
                    <div class="clearfix"></div>       
                    <div class="col-xs-6 col-sm-6 col-md-6">                
                        <input placeholder="โปรดระบุนามสกุล" name="last_name" class="form-control input-lm" type="text" value="" maxlength="255">   
                    </div>
                </div>
                <div class="clearfix"></div>
                <!--End control group-->

                <div class="control-group row">
                    <label for="phone" class="control-label col-xs-6 col-sm-6 col-md-6">เบอร์โทรศัพท์</label>  
                    <div class="clearfix"></div>
                    <div class="col-xs-6 col-sm-6 col-md-6">                                          
                    <input maxlength="11"  placeholder="โปรดระบุเบอร์โทรศัพท์มือถือ (ใช้เป็นชื่อบัญชีผู้ใช้งานระบบ)" name="phone" class="form-control input-lm" type="text" value="" maxlength="255">                                                    
                    </div>
                </div>
                <div class="clearfix"></div>
                <!--End control group-->

                <div class="control-group row">
                    <label class="conrol-label col-xs-6 col-sm-6 col-md-6" for="email">อีเมล์</label>  
                    <div class="clearfix"></div>    
                    <div class="col-xs-6 col-sm-6 col-md-6">                                      
                        <input maxlength="80" placeholder="โปรดระบุอีเมล์ เช่น wabc@gmail.com" name="email" class="form-control " type="text" value="" maxlength="255">                                                    
                    </div>
                </div>
                <div class="clearfix"></div>
                <!--End control group-->

                <div class="control-group row">
                    <label class="conrol-label col-xs-6 col-sm-6 col-md-6" for="email">รหัสบัตรประชาชน</label>  
                    <div class="clearfix"></div>    
                    <div class="col-xs-6 col-sm-6 col-md-6">                                      
                        <input maxlength="13" placeholder="โปรดระบุรหัสบัตรประชาชน 13 หลัก เช่น 1105011104518" name="identity" class="form-control " type="text" value="" maxlength="255">                                                    
                    </div>
                </div>
                <div class="clearfix"></div>
                <!--End control group-->                

                <!-- put your content here -->
                <div class="control-group row">
                    <label class="control-label col-xs-6 col-sm-6 col-md-6" for="position">ตำแหน่ง</label>
                    <div class="clearfix"></div>
                    <div class="controls col-xs-6 col-sm-6 col-md-6">
                        <select id="position" name="position" data-rel="chosen" class="form-control input-lm">

                        </select>
                    </div>

                </div>
                <div class="clearfix"></div>
                <!--End control group-->

                <!-- put your content here -->
                <div class="control-group row ">
                    <label class="control-label col-xs-6 col-sm-6 col-md-6" for="belongto">สังกัด</label>
                    <div class="clearfix"></div>
                    <div class="controls col-xs-6 col-sm-6 col-md-6">
                        <input id="belongto" placeholder="โปรดระบุสังกัด เช่น ฝอ.1 บก.อก." name="belongto" class="form-control typeahead" type="text" value="" maxlength="255">
                    </div>

                </div>
                <div class="clearfix"></div>
                <!--End control group-->

                <!-- put your content here -->
                <div class="control-group row">
                    <label class="control-label col-xs-6 col-sm-6 col-md-6" for="division">หน่วยงาน</label>
                    <div class="clearfix"></div>
                    <div class="controls col-xs-6 col-sm-6 col-md-6">
                        <select id="division" name="division" data-rel="chosen" class="form-control">

                        </select>
                    </div>

                </div>
                <div class="clearfix"></div>
                <!--End control group-->


                <!-- put your content here -->
                <div class="control-group row">
                    <label class="control-label col-xs-6 col-sm-6 col-md-6" for="squad">จังหวัด</label>
                    <div class="clearfix"></div>
                    <div class="controls col-xs-6 col-sm-6 col-md-6">
                        <select id="province" name="province" data-rel="chosen" class="form-control input-lm">

                        </select>
                    </div>

                </div>
                <div class="clearfix"></div>
                <!--End control group-->


                <div class="clearfix form-group"></div>
                <!--End control group-->

                <!-- put your content here -->
                <div class="control-group row">
                    <label class="control-label col-xs-6 col-sm-6 col-md-6" for="squad">อำเภอ</label>
                    <div class="clearfix"></div>
                    <div class="controls col-xs-6 col-sm-6 col-md-6">
                        <select id="district" name="district" data-rel="chosen" class="form-control input-lm">

                        </select>
                    </div>

                </div>
                <div class="clearfix"></div>
                <!--End control group-->


                <div class="clearfix form-group"></div>
                <!--End control group-->

                <!-- put your content here -->
                <div class="control-group row">
                    <label class="control-label col-xs-6 col-sm-6 col-md-6" for="squad">ตำบล</label>
                    <div class="clearfix"></div>
                    <div class="controls col-xs-6 col-sm-6 col-md-6">
                        <select id="subdistrict" name="subdistrict" data-rel="chosen" class="form-control input-lm">

                        </select>
                    </div>

                </div>
                <div class="clearfix"></div>
                <!--End control group-->


                <div class="clearfix form-group"></div>
                <!--End control group-->

       
                <div class="form-actions form-group">
                    <button type="submit" class="btn btn-success"><i class=" icon-ok icon-white"></i> บันทึกค่า</button>
                    <a class="btn btn-primary" href="login.html">
                        <i class="icon-home icon-white"></i> 
                        ยกเลิก
                    </a>
                </div>
                              
                </form>

            </div><!--end box content-->
        </div>
    </div>
</div><!--/row-->


    <!-- content ends -->
    </div><!--/#content.col-md-0-->
</div><!--/fluid-row-->


<?php 

    include_once('include/footer.php'); 

?>
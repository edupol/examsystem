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
                    <a href="index.php">Home</a>
                </li>
                <li>
                    <a href="#">ตรวจสอบผลการทดสอบ</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="box col-md-12">
                <div class="box-inner">
                    <div class="box-header well" data-original-title="">
                        <span class="customFont1"><!-- <i class="glyphicon glyphicon-star-empty"></i> ผลการทดสอบความรุ้ --></span>
                    </div>
                    <div class="box-content">
                        <!-- put your content here -->
                            <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                                <thead>
                                  <tr>
                                      <th>ลำดับที่</th>
                                      <th>ยศ ชื่อ-สกุล</th>
                                      <th>ตำแหน่ง</th>
                                      <th>วันที่ทดสอบ</th>
                                      <th>เวลา</th>
                                      <th>จำนวนข้อสอบ</th>
                                      <th>จำนวนข้อที่ทำ</th>
                                      <th>คะแนนที่ได้</th>
                                  </tr>
                                </thead>   
                                <tbody></tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div><!--/row-->

                <form id="examSubmit" action="" method="POST">
                    <input name="user_id" type="hidden" />
                    <input name="exam_id" type="hidden" />
                </form>
    <!-- content ends -->
    </div><!--/#content.col-md-0-->
</div><!--/fluid-row-->


<?php 

    include_once('include/footer.php'); 

?>

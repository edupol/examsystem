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
                    <a href="#">ค้นหาข้อสอบ</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="box col-md-12">
                <div class="box-inner">
                    <div class="box-header well" data-original-title="">
                        <h2><i class="glyphicon glyphicon-star-empty"></i> รายการข้อสอบ</h2>
                    </div>
                    <div class="box-content">
                        <!-- put your content here -->
                            <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                                <thead>
                                  <tr>
                                      <th>รหัสข้อสอบ</th>
                                      <th>ชื่อแบบทดสอบ</th>
                                      <th>เวลา (นาที)</th>
                                      <th>ระยะเวลาในการทดสอบ</th>
                                      <th></th>
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

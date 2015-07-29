<?php 
    
    include_once('include/header.php'); 

?>
<div class="ch-container">
    <div class="row">
    <?php 
        include_once('include/leftmenu2.php');
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
			            <a href="#">Registration</a>
			        </li>
			    </ul>
			</div>
			<div class="row">
			    <div class="box col-md-12">
			        <div class="box-inner">
			            <div class="box-header well" data-original-title="">
			                <h2><i class="glyphicon glyphicon-star-empty"></i> Admin Panel</h2>


			            </div>
			        </div>
			    </div>
			</div>
		</div><!-- content ends -->

    </div><!--/#content.col-md-0-->
</div><!--/fluid-row-->


<?php 

    include_once('include/footer.php'); 

?>
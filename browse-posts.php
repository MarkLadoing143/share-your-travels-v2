<?php
	require_once('includes/travel-setup.inc.php');
	include '\lib\helpers\functions.php';
   if (session_status() == PHP_SESSION_NONE) {
       session_start();
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <title>Browse Users</title>
   <?php include 'includes/travel-head.inc.php'; ?>
    
    
    
</head>
<body>

<?php include 'includes/travel-header.inc.php'; ?>
   
<div class="container">  <!-- start main content container -->
   <div class="row">  <!-- start main content row -->
      <div class="col-md-3">  <!-- start left navigation rail column -->
         <?php include 'includes/travel-left-rail.inc.php'; ?>
      </div>  <!-- end left navigation rail --> 
      
      <div class="col-md-9">  <!-- start main content column -->
         <ol class="breadcrumb">
           <li><a href="index.php">Home</a></li>
           <li><a href="browse.php">Browse</a></li>
           <li class="active">Posts</li>
         </ol>          
    
         <div class="jumbotron" id="postJumbo">
           <h1>Posts</h1>
           <p>Read other travellers' posts ... or create your own.</p>
			<a href="#" class="btn btn-warning btn-lg">Learn more &raquo;</a>
         </div>        
      
         <div class="postlist">
           
           <?php outputPostRow() ?>

      <?php outputPagination(1,4) ?>
      
      </div>  <!-- end main content column -->
   </div>  <!-- end main content row -->
</div> 
    </div>     
   
<?php include 'includes/travel-footer.inc.php'; ?>   

   
   
 <!-- Bootstrap core JavaScript
 ================================================== -->
 <!-- Placed at the end of the document so the pages load faster -->
 <script src="bootstrap3_travelTheme/assets/js/jquery.js"></script>
 <script src="bootstrap3_travelTheme/dist/js/bootstrap.min.js"></script>
 <script src="bootstrap3_travelTheme/assets/js/holder.js"></script>
</body>
</html>
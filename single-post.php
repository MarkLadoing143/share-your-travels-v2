<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

if(empty($_GET['Pid'])){
	header('Location: error.php');
}

require_once('includes/travel-setup.inc.php');
include '\lib\helpers\functions.php';
	
function getPostName() {
	if( isset($_GET['Pid']) ) {
		$pid = $_GET['Pid'];
		
		$post = new TravelPost(TravelPost::getFieldNames(), false);
		$post->load($pid);
		
		$title = $post->getTitle();
		
		echo utf8_encode($title);
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <title><?php getPostName(); ?></title>
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
           <li><a href="browse-posts.php">Posts</a></li>
          
             
             <?php generateSinglePost() ?>
             
             
      </div>  <!-- end main content column -->
   </div>
    </div><!-- end main content row -->
   <!-- end main content container -->
   
<?php include 'includes/travel-footer.inc.php'; ?>   

   
   
 <!-- Bootstrap core JavaScript
 ================================================== -->
 <!-- Placed at the end of the document so the pages load faster -->
 <script src="bootstrap3_travelTheme/assets/js/jquery.js"></script>
 <script src="bootstrap3_travelTheme/dist/js/bootstrap.min.js"></script>
 <script src="bootstrap3_travelTheme/assets/js/holder.js"></script>
</body>
</html>
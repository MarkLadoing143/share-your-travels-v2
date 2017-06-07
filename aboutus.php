<?php
	require_once('includes/travel-setup.inc.php');
	include 'lib\helpers\functions.php';
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <title>About Us</title>
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
           <li class="active">About Us</li>
         </ol>          
    
         
         <div class="jumbotron">
            <div class="row">
                <h1>About Us</h1>
                <p>This assignment was created by <b>Dan Dobranski</b> and <b>Mark Ladoing</b><br/>It was created for COMP 3512 at Mount Royal University<br/><br/>Tasks Completed by Team Members:
                <br/><br/><b>Dan Dobranski</b> - Revamped code to use a class system, Search functionality, Add to Favorites, View Favorites, Misc. Troubleshooting, Modification of Footer.
                <br/><br/><b>Mark Ladoing</b> - Changes to Bootstrap, Print Cart Functionality, View Print Cart, Bug Fixing and Efficiency checks.
                <br/><br/> We used the following website for the bootstrap customization:
                <br/>http://bootstrap-live-customizer.com/</p>
				
                <a href="#"><button type="button" class="btn btn-primary btn-md">Learn More</button></a>
            </div>
         </div>  

      </div>  <!-- end main content column -->
   </div>  <!-- end main content row -->
</div>   <!-- end main content container -->
   
<?php include 'includes/travel-footer.inc.php'; ?>   

   
   
 <!-- Bootstrap core JavaScript
 ================================================== -->
 <!-- Placed at the end of the document so the pages load faster -->
 <script src="bootstrap3_travelTheme/assets/js/jquery.js"></script>
 <script src="bootstrap3_travelTheme/dist/js/bootstrap.min.js"></script>
 <script src="bootstrap3_travelTheme/assets/js/holder.js"></script>
</body>
</html>
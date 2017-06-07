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
   <title>Browse</title>
   <?php include 'includes/travel-head.inc.php'; ?>
    
    <style>
    .jumbotron{
        background: url("travel-images/large/5857398054.jpg");
    }   
    </style>
    
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
           <li class="active">Browse</li>
         </ol>          
    
         
         <div class="jumbotron">
                <h1>Browse</h1>
                <p>Examine lists of these..<br/></p>
                <a href="#" class="btn btn-warning btn-lg">Learn More &raquo;</a>
         </div>
		 
        <ul class="list-group">
            <li class="list-group-item"><a href="browse-countries.php">Countries</a></li>
            <li class="list-group-item"><a href="browse-images.php">Images</a></li>
            <li class="list-group-item"><a href="browse-posts.php">Posts</a></li>
            <li class="list-group-item"><a href="browse-users.php">Users</a></li>
			<li class="list-group-item"><a href="browse-favorites.php">Favorites</a></li>
			<li class="list-group-item"><a href="browse-cart.php">Shopping Cart</a></li>
        </ul>

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
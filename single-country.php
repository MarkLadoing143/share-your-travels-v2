<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

if(empty($_GET['country'])){
	header('Location: error.php');
}

require_once('includes/travel-setup.inc.php');
include '\lib\helpers\functions.php';

function getCountryTitle() {
	if( isset($_GET['country']) ) {
		$id = $_GET['country'];
		
		$country = new Country(Country::getFieldNames(), false);
		$country->load($id);
		
		$title = $country->getCountryName();
		
		echo utf8_encode($title);
	}
}  
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <title><?php getCountryTitle(); ?></title>
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
           <li><a href="browse-countries.php">Countries</a></li>
           <?php generateSingleCountry(); ?>
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
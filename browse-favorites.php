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
   <title>Browse Favorites</title>
   <?php include 'includes/travel-head.inc.php'; ?>
    
    
    
</head>
<body>

<?php include 'includes/travel-header.inc.php'; ?>
   
<div class="container">  <!-- start main content container -->
   <div class="row">  <!-- start main content row -->     
		<div class="col-md-12">  <!-- start main content column -->

         <ol class="breadcrumb">
           <li><a href="index.php">Home</a></li>
           <li><a href="browse.php">Browse</a></li>
           <li class="active">Favorites</li>
         </ol>          
       
         <div class="jumbotron" id="postJumboFav">
			<h1>Favorites</h1>
			<p>Here is all your favorites<br/></p>
			<a href="emptyfavorites.php" class="btn btn-warning btn-lg">Reset Favorites &raquo;</a>
		</div>
		
       <div class="col-md-6">
        <div class="panel panel-default">
        <div class="panel-heading">Your Favorite Images</div>
        <div class="panel-body">
        <table>
        <tr>
        <th>Image</th>
        <th>Title</th>
        <th>Country</th>

        </tr>
        <?php generateFavoriteImages() ?>
            </table>  
            </div></div></div>
			
        <div class="col-md-6">
        <div class="panel panel-default">
        <div class="panel-heading">Your Favorite Posts</div>
        <div class="panel-body">
        <table>
        <tr>
        <th>Image</th>
        <th>Title</th>
        <th>Author</th>
		<th></th>
        </tr>
        <?php generateFavoritePosts() ?>
		</table>  
		</div>
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
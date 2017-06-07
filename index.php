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
   <title>Index</title>
   <?php include 'includes/travel-head.inc.php'; ?>
</head>
<body>

<?php include 'includes/travel-header.inc.php'; ?>
   
<div class="container">  
   <div class="row">
       
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img src="travel-images/large/9494282329.jpg" width='100%'alt="Chania">
        <div class="carousel-caption">
        <h3>Prato della Valle</h3>
        <p>Prato della Valle in Padova</p>
        <a href="single-image.php?id=46">
        <button type="button" class="btn btn-primary btn-md">Learn More</button>
        </a>
      </div>
    </div>

    <div class="item">
      <img src="travel-images/large/9504451722.jpg" width='100%' alt="Flower">
        <div class="carousel-caption">
        <h3>Interior Santo Spirito, Florence</h3>
        <p>Filippo Brunelleschi designed church has been called by Bernini the most beautiful church in the world. I have to concur with the master, it is beyond stunning</p>
        <a href="single-image.php?id=62">
        <button type="button" class="btn btn-primary btn-md">Learn More</button>
        </a>
      </div>
    </div>

    <div class="item">
      <img src="travel-images/large/8710247776.jpg" width='100%' alt="Flower">
        <div class="carousel-caption">
        <h3>Dusk on Imerovigli (Santorini)</h3>
        <p>Looking towards Imerovigli, a village devoted to the appreciation of the sunset!</p>
        <a href="single-image.php?id=77">
        <button type="button" class="btn btn-primary btn-md">Learn More</button>
        </a>
      </div>
    </div>
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
   </div>
       
        <!-- start left navigation rail column -->
        
         
             
           
         
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
<?php
require_once('includes/travel-setup.inc.php');
include '\lib\helpers\functions.php';

if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

//if shipping method not set or cart empty, default to standard
if( !isset($_SESSION['ShippingMethod']) || empty($_SESSION['ShoppingCart']) ) {
	$_SESSION['ShippingMethod'] = "Standard"; 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Browse Shopping Cart</title>
	<?php include 'includes/travel-head.inc.php'; ?>   
</head>
<body>

<?php include 'includes/travel-header.inc.php'; ?>
   
<div class="container">  <!-- start main content container -->
	<div class="row">  <!-- start main content row -->   
		<div class="col-md-12">   <!-- start main content column -->
	   
		<ol class="breadcrumb">
			<li><a href="index.php">Home</a></li>
			<li class="active">Shopping Cart</li>
		</ol>  
		
		<div class="jumbotron" id="postJumboFav">
			<h1>Shopping Cart</h1>
			<p>Purchase your own prints<br/></p>
			<a href="emptyCart.php" class="btn btn-warning btn-lg">Reset Cart &raquo;</a>
		</div>
		
		<div class="panel panel-default">
        <div class="panel-heading">Your Shopping Cart</div>
        <div class="panel-body">
		<form action="updateCart.php" method="get">
			<table class="table table-condensed">
				<tr>
					<th>Image</th>
					<th>Title</th>
					<th>Quantity</th>
					<th>Size</th>
					<th>Stock</th>
					<th>Frame</th>
					<th>Price</th>
					<th>Total</th>
					<th></th> <!-- Remove -->
				</tr>
					<?php generateCart(); ?>
				<tr class="success strong">
					<td colspan="7" align="right"><b>Subtotal</b></td>
					<td colspan="2"><b><?php echo "$" . number_format(calculateSubTotal(), 2); ?></b></td>
				</tr>
				<tr class="strong">
					<td colspan="5"><b>Shipping Options</b>
						<select name="shipping">
							<option value="Standard" <?php if($_SESSION['ShippingMethod'] == "Standard") {echo "selected='selected'";} else {echo "";}; ?> >Standard</option>
							<option value="Express" <?php if($_SESSION['ShippingMethod'] == "Express") {echo "selected='selected'";} else {echo "";}; ?> >Express</option>
						</select>
					</td>
					<td colspan="2" align="right"><b>Shipping Cost</b></td>
					<td colspan="2"><b><?php echo "$" . number_format(calculateShipping(), 2); ?></b></td>
				</tr>
				<tr class="warning strong text-danger">
					<td colspan="7" align="right"><b>Grand total</b></td>
					<td colspan="2"><b><?php echo "$" . number_format(calculateGrandTotal(), 2); ?></b></td>
				</tr>
				<tr>
					<td colspan="6" align="right"><a href="#" class="btn btn-success" id="cartButton" >Add an Order</a></td>
					<td><button type="submit" value="Submit" class="btn btn-info" id="cartButton" >Update Cart</button></td>
					<td colspan="2"><a href="index.php" class="btn btn-primary" id="cartButton" >Continue Shopping</a></td>
				</tr>
			</table>  
		</form>
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
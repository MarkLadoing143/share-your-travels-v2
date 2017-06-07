<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

//define default settings here for code design
define("DEFAULT_QTY",1);
define("DEFAULT_SIZE","8x10");
define("DEFAULT_STOCK","Matte");
define("DEFAULT_FRAME","None");
define("DEFAULT_PRICE",2.50);


require_once('includes/travel-setup.inc.php');
include '\lib\helpers\functions.php';

if( isset($_GET['id']) ) {	
	$id= $_GET['id'];
	
	$image = new TravelImage(TravelImage::getFieldNames(), false);
    $image->load($id);
	
    $path = $image->getPath();
    $title = utf8_encode($image->getTitle());
	
	$cartItem = array('ID'=>$id,'Path'=>$path,'Title'=>$title, 'Quantity'=>DEFAULT_QTY, 'Size'=>DEFAULT_SIZE, 'Stock'=>DEFAULT_STOCK, 'Frame'=>DEFAULT_FRAME, 'Price'=>DEFAULT_PRICE);
		
	if(inCart($cartItem) != true) {
		$_SESSION["ShoppingCart"][$id] = $cartItem;
	}
	
	header('Location: browse-cart.php'); 
}

//helper that checks cart if item already exists
function inCart($array) { 
	foreach($_SESSION["ShoppingCart"] as $itemNum=>$item) {
		if($item['ID'] == $array['ID'] && $item['Title'] == $array['Title'] && $item['Path'] == $array['Path']) {
			return true;
		}
	}
}
	
?>
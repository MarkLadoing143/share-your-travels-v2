<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

require_once('includes/travel-setup.inc.php');
include '\lib\helpers\functions.php';

if( isset($_GET) && !empty($_GET) ) {
	if( !empty($_SESSION['ShoppingCart']) ) {
		$previousID = null;
		foreach($_GET as $key => $value) {
			$name = explode('-',$key);
			$id = end($name);
			
			if(is_numeric($id) && $id != $previousID) {	//checks for repeat values and to skip shipping	(as that is used later)
				if( is_numeric($_GET['quantity-' . $id]) && (int)$_GET['quantity-' . $id] > 0) {
					$_SESSION['ShoppingCart'][$id]['Quantity'] = (int)$_GET['quantity-' . $id];
				}
				$_SESSION['ShoppingCart'][$id]['Size'] = $_GET['size-' . $id];
				$_SESSION['ShoppingCart'][$id]['Stock'] = $_GET['stock-' . $id];
				$_SESSION['ShoppingCart'][$id]['Frame'] = $_GET['frame-' . $id];
			}
			
			$previousID = $id;
		}
	}
	
	if( isset($_GET['shipping']) && !empty($_GET['shipping']) ) { //updates the method of shipping
		$_SESSION['ShippingMethod'] = $_GET['shipping'];
	}
}
header('Location: ' . $_SERVER['HTTP_REFERER']); 
?>
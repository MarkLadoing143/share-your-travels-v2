<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
	
require_once('includes/travel-setup.inc.php');
include '\lib\helpers\functions.php';

if( isset($_GET['id']) ) {
	$id= $_GET['id'];

	$image = new TravelImage(TravelImage::getFieldNames(), false);
	$image->load($id);
	$country = new Country(Country::getFieldNames(), false);
	$country->load($image->getCountryCodeISO());

	$countryName = utf8_encode($country->getCountryName());
	$title = utf8_encode($image->getTitle());
	$path = $image->getPath();

	$favorite = array('ID'=>$id,'Path'=>$path,'Title'=>$title,'Country'=>$countryName);
	$_SESSION['FavoriteImages'][$id] = $favorite;

	header('Location: single-image.php?id=' .$id);
}   
elseif( isset($_GET['Pid']) ) { 
        $pid= $_GET['Pid'];

		$image = new TravelImage(TravelImage::getFieldNames(), false);
		$image->load($pid);
		$user = new TravelUser(TravelUser::getFieldNames(), false);
		$user->load($image->getUID());
		
		$firstName = utf8_encode($user->getFirstName());
		$lastName = utf8_encode($user->getLastName());
		$author = $firstName . " " . $lastName;
		$title = utf8_encode($image->getTitle());
		$path = $image->getPath();
		
		$favorite = array('PID'=>$pid,'Path'=>$path,'Title'=>$title,'Author'=>$author);
		$_SESSION['FavoritePosts'][$pid] = $favorite;
		
		header('Location: single-post.php?Pid=' .$pid);
    }
?>
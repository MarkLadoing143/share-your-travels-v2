<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
    }

$pid = $_GET['Pid'];

 unset($_SESSION['FavoritePosts'][$pid]);


header('Location: ' . $_SERVER['HTTP_REFERER']); 

?>

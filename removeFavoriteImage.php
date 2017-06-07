<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
    }

$id = $_GET['id'];

unset($_SESSION['FavoriteImages'][$id]);


header('Location: ' . $_SERVER['HTTP_REFERER']); 

?>
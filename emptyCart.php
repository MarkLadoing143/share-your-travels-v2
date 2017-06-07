<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$_SESSION["ShoppingCart"] = null;

header('Location: ' . $_SERVER['HTTP_REFERER']);
?>
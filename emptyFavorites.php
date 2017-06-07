<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$_SESSION['FavoriteImages'] = null;
$_SESSION['FavoritePosts'] = null;

header('Location: ' . $_SERVER['HTTP_REFERER']);
?>
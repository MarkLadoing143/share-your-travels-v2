<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

    $helper = array_keys($_SESSION);
    foreach ($helper as $key){
        unset($_SESSION[$key]);
    }
    
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>
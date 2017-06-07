<?php
require_once('lib/protected/config.php');

spl_autoload_register(function ($class) {
    $file = 'lib/myClasses/' . $class . '.class.php';
    if (file_exists($file)) 
      include $file;
    else
      include 'lib/model/' . $class . '.class.php';
});

$dbAdapter = DatabaseAdapterFactory::create('PDO', array(DBCONNSTRING, DBUSER, DBPASS));

?>
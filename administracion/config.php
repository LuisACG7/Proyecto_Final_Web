<?php
session_start();

define('DB_DRIVER', 'mysql');
//define('DB_DRIVER', 'pgsql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'estetica');
define('DB_USER', 'estetica');
define('DB_PASSWORD', '1234');
define('DB_PORT', '3306');
//define('DB_PORT', '5432');


define('APP_NAME', "Glamour Memo's");


class config {
    function __getImageSize(){
        return 512000;
    }
    function __getImageType(){
        return array('image/jpeg','image/png','image/gif');
    }
}

?>
<?php 

define('DB_NAME','u404196363_login_db');
define('DB_USER','u404196363_vskmasterdb');
define('DB_PASS','Mr&Kc.eU#3Y+yj_');
define('DB_HOST','vskinsaan.com');


$string = "mysql:host=".DB_HOST.";dbname=".DB_NAME;

if(!$connection = new  PDO($string,DB_USER,DB_PASS))
{
    die("Failed to connect!");
}
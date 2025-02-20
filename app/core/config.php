<?php

if ($_SERVER['SERVER_NAME'] == 'localhost') {

    /** database config **/
    define('DBNAME', 'w360');
    define('DBHOST', 'localhost');
    define('DBUSER', 'root');
    define('DBPASS', '');
    define('DBDRIVER', 'localhost');

    define('ROOT', 'http://localhost/CS45/public');
} else {
    /** database config **/
    define('DBNAME', 'w360');
    define('DBHOST', 'localhost');
    define('DBUSER', 'root');
    define('DBPASS', '');
    define('DBDRIVER', 'localhost');

    define('ROOT', 'http://www.website.com');
}

define('APP_NAME', "w360");
define('APP_DESC', "Polythene Recycling Company");

//true means hsow errors
define('DEBUG', true);

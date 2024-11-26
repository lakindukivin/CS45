<?php

if ($_SERVER['SERVER_NAME'] == 'localhost') {

    /** database config **/
    define('DBNAME', 'waste360');
    define('DBHOST', 'localhost');
    define('DBUSER', 'root');
    define('DBPASS', '');
    define('DBDRIVER', 'localhost');

    define('ROOT', 'http://localhost/CS45/public');
} else {
    /** database config **/
    define('DBNAME', 'waste36');
    define('DBHOST', 'localhost');
    define('DBUSER', 'root');
    define('DBPASS', '');
    define('DBDRIVER', 'localhost');

    define('ROOT', 'http://www.website.com');
}

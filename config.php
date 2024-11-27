<?php

session_start();

define('DB_HOST', 'localhost');
define('DB_NAME', 'Try-session-login');
define('DB_USER', 'root');
define('DB_PASS', 'root');
define('PEPPER', 'asd9853du');

$conn = 'mysql:host' . DB_HOST . ';dbname=' . DB_NAME;
$db = new pdo($conn, DB_USER, DB_PASS);
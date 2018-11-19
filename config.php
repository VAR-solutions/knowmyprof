<?php

/**
 * Configuration for database connection
 *
 */
$host = "localhost";
$hostname = "itbois";
$hostpwd = "Password@123";
$dbname = "it";
$db = mysqli_connect($host, $hostname, $hostpwd, $dbname);
$dsn = "mysql:host=$host;dbname=$dbname";
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
);


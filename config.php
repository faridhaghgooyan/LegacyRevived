<?php
date_default_timezone_set('Asia/Tehran');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = 'localhost';
$username = 'root';
$password = 'root';
$database = 'LegacyRevived';

try {
    $db = new \PDO("mysql:host=$servername;dbname=$database;charset=utf8",
        $username, $password);
    $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
}
catch(Exception $e) {
    die($e->getMessage());

}



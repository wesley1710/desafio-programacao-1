<?php
ini_set("display_errors", 1);
error_reporting(E_ALL);

$dsn = 'mysql:dbname=desafio;host=localhost';
$user = 'root';
$password = '';

$conn = "";

try {
    $conn = new PDO($dsn, $user, $password, array(
	    PDO::ATTR_EMULATE_PREPARES=>false,
	    PDO::MYSQL_ATTR_DIRECT_QUERY=>false,
	    PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION
	));
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    exit;
}
<?php
date_default_timezone_set('Asia/Manila');
// Connection variables
$host = "localhost"; // MySQL host name eg. localhost

$user = "root"; // MySQL user. eg. root ( if your on localserver)

$password = ""; // MySQL user password (if password is not set for your root user then keep it empty )

$database = "codemon_db_school_5"; // MySQL Database name

// Connect to MySQL Database

$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
<?php
// Database connection
$host = 'localhost';
$db_username = 'root';
$db_password = '';
$dbname = 'alumni_management';

$conn = new mysqli($host, $db_username, $db_password, $dbname);

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
?>
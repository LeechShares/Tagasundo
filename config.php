<?php
$servername = "sql306.hstn.me";
$username = "mseet_34966110";
$password_db = "rejard07";
$dbname = "mseet_34966110_tagasundo";

$conn = new mysqli($servername, $username, $password_db, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
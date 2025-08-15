<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "istria";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Greška pri spajanju: " . $conn->connect_error);
}
?>

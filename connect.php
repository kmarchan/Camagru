<?php
session_start();
$servername = "localhost";
$ad_username = "root";
$ad_password = "c3x6TkahjMZCgw";
$dbname = "camagru_db";
// $conn = mysqli_connect($servername, $username, $password);
$db = new PDO("mysql:host=$servername;dbname=$dbname", $ad_username, $ad_password);
if (!$db) {
	die("Connection failed: " . mysqli_connect_error());
}
// if (!$conn) {
// 	die("Connection failed: " . mysqli_connect_error());
// }
?>
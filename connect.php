<?php
$servername = "localhost";
$ad_username = "root";
$ad_password = "c3x6TkahjMZCgw";
$dbname = "camagru_db";

$opt = [
PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
PDO::ATTR_EMULATE_PREPARES   => false,
];

$db = new PDO("mysql:host=$servername;dbname=$dbname", $ad_username, $ad_password, $opt);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if (!$db)
{
	die("Connection failed: " . mysqli_connect_error());
}
?>

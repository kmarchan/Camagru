<?php
require "connect.php";
include "server.php";
if(isset($_GET['delete']))
{
	if ($_SESSION['username'])
	{
		$usr = $_SESSION['username'];
		echo $usr;
		$sql = "DELETE FROM $dbname.users WHERE username='$usr'";
    $db->exec($sql);
		// $connect = include "connect";
		// mysqli_query($connect, $sql);
    echo "Account Deleted";
    session_destroy();
    unset($_SESSION['username']);
    header('location:index.php');
		exit();
	}
}
if (isset($_POST['submit']))
{
	print_r($_SESSION);
	$usr = $_SESSION['user'];
	$new_usr = $_POST['login'];
	$new_pass = $_POST['password'];
	mysqli_query($link, "UPDATE users set password='$new_pass' where username='$usr'");
	mysqli_query($link, "UPDATE users set username='$new_usr' where username='$usr'");
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Account Settings</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
	<?php include_once("header.php")?>
		<div id="pageContent">
            <div class="header" id="head" align="center">
            <p align="center" ><h2>Change Login Details</h2>
            </div>
            <form method="POST" action="">
            <input name="login" type="login" placeholder="New username" >
    				<br>
    				<input name="password" type="password" placeholder="New password">
    				<br>
    				<button value="OK" name="submit" type="submit" >OK</button>
            <p>or <a href="account.php?delete=yes" >delete account?</a></p>
    </div>
</body>
</html>

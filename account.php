<?php
require "config/database.php";
include "server.php";
if(isset($_GET['delete']))
{
	if ($_SESSION['username'])
	{
		$usr = $_SESSION['username'];
		echo $usr;
		$sql = "DELETE FROM $dbname.users WHERE username='$usr'";
    $db->exec($sql);
    echo "Account Deleted";
    session_destroy();
    unset($_SESSION['username']);
    header('location:index.php');
		exit();
	}
}
if (isset($_POST['change']))
{
	$usr = $_SESSION['username'];
	if (isset($_POST['login']))
	{
		$new_usr = $_POST['login'];
	}
	if (isset($_POST['email']))
	{
		$new_email = $_POST['email'];
	}
	if (isset($_POST['password']) && !empty($_POST['password']))
	{
		$pass = $_POST['password'];
		$new_pass = hash('whirlpool', $pass);
	}

	if ($new_email)
	{
		$sql = "UPDATE users set `email`='$new_email' where `username` ='$usr'";
		$db->exec($sql);
	}
	if ($new_pass)
	{
		$sql = "UPDATE users set `password`='$new_pass' where `username` ='$usr'";
		$db->exec($sql);
	}
	if ($new_usr)
	{
		$sql = "UPDATE users set `username`='$new_usr' where `username` ='$usr'";
		$db->exec($sql);
	}
	session_destroy();
    unset($_SESSION['username']);
	header('location:index.php');

}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Account Settings</title>
		<link rel="stylesheet" type="text/css" href="style.css" />
	</head>
	<body>
		<?php include_once("header.php")?>
			<div id="pageContent">
				<div class="header" id="head" align="center">
					<p align="center" ><h2>Change Login Details</h2>
				</div>
				<form method="POST" action="">
					<input name="login" type="login" placeholder="New username" pattern="[^()/><\][\\\x22,;|]+">
					<button value="OK" name="change" type="submit" >OK</button>
					<br>
					<input name="email" type="email" placeholder="New email" pattern="[^()/><\][\\\x22,;|]+">
					<button value="OK" name="change" type="submit" >OK</button>
					<br>
					<input name="password" type="password" placeholder="New password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{4,}[^()/><\][\\\x22,;|]+" title="Password must contain at least one number and one uppercase and lowercase letter, and at least 4 or more characters and no brackets or quotation marks">
					<button value="OK" name="change" type="submit" >OK</button>
					<p>or <a href="account.php?delete=yes" >delete account?</a></p>
				</form>
			</div>
	</body>
</html>

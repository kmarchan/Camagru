<?php
	session_start();
    require('connect.php');
	$username = $_GET['username'];
	$confirmcode = $_GET['code'];
	$query = $db->prepare("SELECT confirmed FROM $dbname.users WHERE username = :usr AND confirmcode = :con ");
	$query->execute(["usr"=>$username , "con"=>$confirmcode]);
    $result = $query->fetch();
	
	$_SESSION['message'] = count($result);
	if (count($result) == 1)
	{
		$update_con = "UPDATE $dbname.users SET confirmed=1 WHERE username='$username' AND confirmcode='$confirmcode'";
		if ($db->exec($update_con))
		{
			$login_message = "Your account is active! You can now login!";
			$_SESSION['message'] = $login_message;
		}
		else
		{
			$_SESSION['error'] = "Error Authenticating";
		}
		header('Location: index.php');
	}
	else
	{
		$error = "Problem Authenticating";
		// $_SESSION['error'] = count($result);
		$_SESSION['error'] = $error;
		header('Location: index.php');
	}
?>
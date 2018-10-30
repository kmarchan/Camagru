<?php
if (isset($_POST['value']))
{
  $servername = "localhost";
  $ad_username = "root";
  // $ad_password = "c3x6TkahjMZCgw";
  $ad_password = $_POST['value'];
  $dbname = "camagru_db";

  $opt = [
		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
		PDO::ATTR_EMULATE_PREPARES   => false,
	];

	$conn = new PDO("mysql:host=$servername", $ad_username, $ad_password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $deleteDB = " DROP DATABASE $dbname";

  $sqldb = "CREATE DATABASE $dbname";
  $users = "CREATE TABLE $dbname.users (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR (255) UNIQUE,
    name VARCHAR (255),
    surname VARCHAR (255),
    email VARCHAR (255) UNIQUE,
    password VARCHAR (1024),
    confirmed BIT DEFAULT 0,
    confirmcode VARCHAR (1024))";
  $images = "CREATE TABLE $dbname.images (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    pic VARCHAR (255) UNIQUE,
    title VARCHAR (255),
    confirmcode VARCHAR (1024))";

  $conn->exec($deleteDB);

  if ($conn->exec($sqldb))
  {
    echo "Database created successfully\n ".rand(0,100)."<BR /> ";
    $conn->exec($users);
    echo "User Table created successfully\n <BR />";
      $conn->exec($images);
      echo "Images Table created successfully\n <BR />";
  }
  else
  {
    echo "Error creating database: " . $conn->error;
  }
}
?>

<html>
  <head>
  	<title>Database</title>
  	<link rel="stylesheet" type ="text/css" href="./Users/reg_style.css">
  </head>
  <body>
  	<div class="header">
  		<h1>Database Controls</h1>
  		<h2>Reset Database?</h2>
  	</div>

  		<form method="post" action="" id="regform">
  		<div >
  			<center>
  				<h3> Enter Database Password? </h3>
  				<input type="password" name="value">
  				<input type="submit">
  			</center>
  		</div>
  		</form>
  </body>
</html>

<?php
if (isset($_POST['value']))
{
  $servername = "localhost";
  $ad_username = "root";
//  $ad_password = "c3x6TkahjMZCgw";
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
    username VARCHAR (255),
    pic LONGTEXT NOT NULL,
    sub_datetime TIMESTAMP)";

  $comments = "CREATE TABLE $dbname.comments (
    id LONGTEXT NOT NULL,
    username VARCHAR (255),
    comment VARCHAR (255),
    datetime TIMESTAMP)

  )";

  $likes = "CREATE TABLE $dbname.likes (
    image_id INT 
  )";

  $conn->exec($deleteDB);

  if ($conn->exec($sqldb))
  {
    echo "Database created successfully\n ".rand(0,100)."<BR /> ";
    $conn->exec($users);
    echo "User Table created successfully\n <BR />";
    $conn->exec($images);
    echo "Images Table created successfully\n <BR />";
    $conn->exec($likes);
    echo "likes Table created successfully\n <BR />";
    $conn->exec($comments);
    echo "comment Table created successfully\n <BR />";
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

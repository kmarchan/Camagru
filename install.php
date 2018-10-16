<?php
// include('connect_database.php');
$servername = "localhost";
$username = "root";
$password = "c3x6TkahjMZCgw";
$dbname = "camagru_db";
$conn = mysqli_connect($servername, $username, $password);
$users = "CREATE TABLE $dbname.users (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR (255) UNIQUE,
    firstname VARCHAR (255),
    surname VARCHAR (255),
    email VARCHAR (255) UNIQUE,
    password VARCHAR (255))";
$users = "CREATE TABLE $dbname.users (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR (255) UNIQUE,
    firstname VARCHAR (255),
    surname VARCHAR (255),
    email VARCHAR (255) UNIQUE,
    password VARCHAR (255),
    confirmed BIT DEFAULT 0,
    confirmcode INT)";
    
$sqldb = "CREATE DATABASE $dbname";
$deleteDB = " DROP DATABASE $dbname";
mysqli_query($conn, $deleteDB);
if (mysqli_query($conn, $sqldb) === TRUE)
{
    echo "Database created successfully\n ".rand(0,100)."<BR /> ";
    if (mysqli_query($conn, $users) === TRUE)
    {
        echo "User Table created successfully\n <BR />";
    }
    else
    {
        echo "User Table FAILED\n <BR />";
    }
}
else
{
    echo "Error creating database: " . $conn->error;
}
$conn->close();
?>
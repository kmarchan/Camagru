<?php
    session_start();
    require('connect.php');
    // start_session();
    $username = "";
    $email = "";
    $name = "";
    $surname = "";
    $errors = array();

    $db = new PDO("mysql:host=$servername;dbname=$dbname", $ad_username, $ad_password);
    if (isset($_POST['register'])) {
        $username = ($_POST['username']);
        $name = ($_POST['name']);
        $surname = ($_POST['surname']);
        $email = ($_POST['email']);
        $password_1 = ($_POST['password_1']);
        $password_2 = ($_POST['password_2']);

        if(empty($username)) {
            array_push($errors, "Username is required");
        }
        if(empty($name)) {
            array_push($errors, "Name is required");
        }
        if(empty($surname)) {
            array_push($errors, "Surname is required");
        }
        if(empty($email)) {
            array_push($errors, "Email is required");
        }
        if(empty($password_1)) {
            array_push($errors, "Password is required");
        }
        if($password_1 != $password_2) {
            array_push($errors, "The two passwords do not match");
        }
        if(count($errors == 0)) {
            $password = hash("whirlpool", $password_1);
            $sql = "INSERT INTO users (username, name, surname, email, password) VALUES ('$username', '$name', '$surname', '$email', '$password')";
            $db->exec($sql);
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "Login Successful!";
            header('location: index.php');
        }
    }
    
?>
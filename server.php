<?php
    session_start();
    require('connect.php');
    $username = "";
    $email = "";
    $name = "";
    $surname = "";
    $errors = array();

    // $opt = [
    // PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    // PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    // PDO::ATTR_EMULATE_PREPARES   => false,
    // ];

    try {
    // $db = new PDO("mysql:shost=$servername;dbname=$dbname", $ad_username, $ad_password);
    // $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // if (!$db)
    // {
    // 	die("Connection failed: " . mysqli_connect_error());
    // }
    if (isset($_POST['register']))
    {
        $username = ($_POST['username']);
        $name = ($_POST['name']);
        $surname = ($_POST['surname']);
        $email = ($_POST['email']);
        $password_1 = ($_POST['password_1']);
        $password_2 = ($_POST['password_2']);
        // console.log($username);
        if(empty($username))
        {
            array_push($errors, "Username is required");
        }
        if(empty($name))
        {
            array_push($errors, "Name is required");
        }
        if(empty($surname))
        {
            array_push($errors, "Surname is required");
        }
        if(empty($email))
        {
            array_push($errors, "Email is required");
        }
        if(empty($password_1))
        {
            array_push($errors, "Password is required");
        }
        if($password_1 != $password_2)
        {
            array_push($errors, "The two passwords do not match");
        }
        $stmt = $db->prepare("SELECT * FROM camagru_db.users WHERE username = :usr OR email = :eml");
        $stmt->execute(["usr"=>$username, "eml"=>$email]);
        $results = $stmt->fetchAll();
        if (sizeof($results) >= 1)
        {
          array_push($errors, "Username/Email already in use");
        }
        if(count($errors) == 0)
        {
            $password = hash("whirlpool", $password_1);
            $sql = "INSERT INTO users (username, name, surname, email, password) VALUES ('$username', '$name', '$surname', '$email', '$password')";
            $db->exec($sql);
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "Login Successful!";
            header('location: index.php');
        }
    }
}
    catch(PDOException $e)
    {
        echo $sql . "<br>" . $e->getMessage();
    }
    if (isset($_GET['logout']))
    {
        session_destroy();
        unset($_SESSION['username']);
        header('location:index.php');
    }


    if (isset($_POST['login']))
    {
      $username = ($_POST['username']);
      $password = ($_POST['password']);
      if (empty($username))
      {
          array_push($errors, "Username is required");
      }
      if (empty($password))
      {
          array_push($errors, "Password is required");
      }
      if(count($errors) == 0)
      {
          $db = new PDO("mysql:host=$servername;dbname=$dbname", $ad_username, $ad_password, $opt);
          $password = hash('whirlpool', $password);
          $statment = $db->prepare("SELECT * FROM camagru_db.users WHERE `username` = :usr AND `password` = :psw");
          $statment->execute(["usr"=>$username, "psw"=>$password]);
          $results = $statment->fetchAll();
          array_push($errors, $result);
          if (sizeof($results) >= 1)
          {
               $_SESSION['username'] = $username;
               $_SESSION['success'] = "Login Successful";
               header('location: index.php');
          }
          else
          {

            $_SESSION['failed'] = "The username/password provided is invalid";
            header('location: login.php');
            //    array_push($errors, "The username/password provided is invalid");
            //    header('location: login.php');
          }
        }
    }
?>

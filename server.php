<?php
    session_start();
    require('config/database.php');
    $username = "";
    $email = "";
    $name = "";
    $surname = "";
    $errors = array();

    // $username = $_GET['username'];
    // $confirmcode = $_GET['code'];

    $stmt = $db->prepare("SELECT * FROM camagru_db.users WHERE username = :usr OR email = :eml");
    $stmt->execute(["usr"=>$username, "eml"=>$email]);
    $results = $stmt->fetchAll();

    try
    {
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
            // else
            // {
            //     $error = "Problem Authenticating";
            //     $_SESSION['error'] = $error;
            //     header('Location: index.php');
            // }
            if (sizeof($results) >= 1)
            {
                array_push($errors, "Username/Email already in use");
            }

            if(count($errors) == 0)
            {
                $password = hash("whirlpool", $password_1);
                $confirmcode = rand();
                $sql = "INSERT INTO users (username, name, surname, email, password, confirmcode) VALUES ('$username', '$name', '$surname', '$email', '$password', '$confirmcode')";
                $db->exec($sql);
                $headers = "From: noreply@localhost.co.za\r\n";
                $headers .= "Reply-To: noreply@localhost.co.za\r\n";
                $headers .= "Return-Path: noreply@localhost.co.za\r\n";
                $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                $message = "<h1>Activate Your Account.</h1>
                Click the link below to Verify your account <br />
                <br />
                    For <strong>Localhost Activation </strong> use the following : <br />
                        http://localhost:8080/Camagru/email_confirm.php?username=$username&code=$confirmcode <br />
                <h2>Enjoy</h2>
                ";
                mail($email, "Activation email", $message , $headers);
                $login_message = "Check Your Email for the Activation link";
                $_SESSION['message'] = $login_message;
                header('Location: index.php');
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
          $statment = $db->prepare("SELECT * FROM camagru_db.users WHERE `username` =:usr AND `password` =:psw");
          $statment->execute(["usr"=>$username, "psw"=>$password]);
          $results = $statment->fetchAll();
          // array_push($errors, $result);
          $is_confirm = $db->prepare("SELECT * FROM $dbname.users WHERE username=:usr AND password =:psw AND confirmed =:bool");
          $is_confirm->execute(["usr"=>$username, "psw"=>$password , "bool"=>1]);
          $is_confirmed_res =$is_confirm->fetchAll();
          if (sizeof($results) == 1 && count($is_confirmed_res) == 1)
          {
               $_SESSION['username'] = $username;
               $_SESSION['success'] = "Login Successful";
               header('location: index.php');
          }
          else
          {
            array_push($errors, "The username/password provided is invalid or your account needs to be activated");
          }
        }
    }

    if (isset($_POST['recover']))
    {
        $email = ($_POST['email']);
        if(empty($email))
        {
            array_push($errors, "Email is required");
        }
        $stmt = $db->prepare("SELECT * FROM camagru_db.users WHERE email = :eml");
        $stmt->execute(["eml"=>$email]);
        $result = $stmt->fetchAll();
        if (sizeof($result) != 1)
        {
            array_push($errors, "Please use the email address you registered with");
        }
        if (sizeof($result) == 1)
        {
            $confirmcode = md5($email);
            $password = hash("whirlpool", $confirmcode);
            $sql = "UPDATE $dbname.users SET `password`='$password' WHERE `email`= '$email'";
            $db->exec($sql);
            $headers = "From: noreply@localhost.co.za\r\n";
            $headers .= "Reply-To: noreply@localhost.co.za\r\n";
            $headers .= "Return-Path: noreply@localhost.co.za\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
            $message = "<h1>Password Reset.</h1>
            Click the link below to reset your password <br />
            <br />
                For <strong>Password Reset </strong> : <br />
                    Your password has been set to $confirmcode click the
                    link below to login and then proceed to account Settings to change your password.
                    http://localhost:8080/Camagru/login.php <br />
            <h2>Enjoy</h2>
            ";
            mail($email, "Password Reset", $message , $headers);
            $login_message = "Check Your Email for your new password";
            $_SESSION['message'] = $login_message;
            header('Location: index.php');
        }
    }

    if (isset($_POST['save']))
    {
        $username = $_SESSION['username'];
        $pic = $_POST['pic'];
        $db = new PDO("mysql:host=$servername;dbname=$dbname", $ad_username, $ad_password, $opt);
        $sql = "INSERT INTO images (username, pic) VALUES ('$username', '$pic')";
        $db->exec($sql);
//       echo $_POST["pic"];
    }
?>

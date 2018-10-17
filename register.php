<?php include('server.php');?>
<!DOCTYPE html>
<html>
    <head>
        <title>Registration</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>

    <body>
        <?php include_once("header.php")?>
        <div class="header" id="head">
            <h2>Register</h2>
        </div>
        <form method="post" action="register.php" id="reg">
            <?php include('errors.php');?>
            <div class="input-group">
                <label>Username</label>
                <input type="text" name="username" value="<?php echo $username; ?>">
            </div>
            <div class="input-group">
                <label>Name</label>
                <input type="text" name="name" value="<?php echo $name; ?>">
            </div>
            <div class="input-group">
                <label>Surname</label>
                <input type="text" name="surname" value="<?php echo $surname; ?>">
            </div>
            <div class="input-group">
                <label>Email</label>
                <input type="text" name="email" value="<?php echo $email; ?>">
            </div>
            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password_1">
            </div>
            <div class="input-group">
                <label>Confirm Password</label>
                <input type="password" name="password_2">
            </div>
            <div class="input-group">
                <button type="submit" name="register" class="button">Register</button>
            </div>
            <p>
                Already registered? <a href="login.php">Login</a>
            </p>
        </form>
    </body>
</html>
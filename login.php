<!DOCTYPE html>
<?php include('server.php');?>
<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>

    <body>
        <?php include_once("header.php")?>
        <div class="header" id="head">
            <h2>Login</h2>
        </div>
        <form method="post" action="login.php" id="reg">
          <?php include('errors.php');?>
            <div class="input-group">
                <label>Username</label>
                <input type="text" name="username" pattern="[^()/><\][\\\x22,;|]+">
            </div>
            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password" pattern="[^()/><\][\\\x22,;|]+">
            </div>
            <div class="input-group">
                <button type="submit" name="login" class="button">Login</button>
            </div>
            <p>
                New here? <a href="register.php">Sign up</a>
                <br> 
                Forgot password? <a href="reset_password.php">Reset</a>
            </p>
        </form>
    </body>
</html>

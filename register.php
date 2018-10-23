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
                <input type="text" name="username" pattern="[^()/><\][\\\x22,;|]+" value="<?php echo $username; ?>">
            </div>
            <div class="input-group">
                <label>Name</label>
                <input type="text" name="name" pattern="[^()/><\][\\\x22,;|]+" value="<?php echo $name; ?>">
            </div>
            <div class="input-group">
                <label>Surname</label>
                <input type="text" name="surname" pattern="[^()/><\][\\\x22,;|]+" value="<?php echo $surname; ?>">
            </div>
            <div class="input-group">
                <label>Email</label>
                <input type="email" name="email" pattern="[^()/><\][\\\x22,;|]+" value="<?php echo $email; ?>">
            </div>
            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password_1" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{4,}[^()/><\][\\\x22,;|]+" title="Password must contain at least one number and one uppercase and lowercase letter, and at least 4 or more characters and no brackets or quotation marks">
            </div>
            <div class="input-group">
                <label>Confirm Password</label>
                <input type="password" name="password_2" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{4,}[^()/><\][\\\x22,;|]+" title="Password must contain at least one number and one uppercase and lowercase letter, and at least 4 or more characters and no brackets or quotation marks">
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
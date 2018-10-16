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
        <form method="post" action="register.php">
            <div class="input-group">
                <label>Username</label>
                <input type="text" name="Username">
            </div>
            <div class="input-group">
                <label>Name</label>
                <input type="text" name="name">
            </div>
            <div class="input-group">
                <label>Surname</label>
                <input type="text" name="surname">
            </div>
            <div class="input-group">
                <label>Email</label>
                <input type="text" name="email">
            </div>
            <div class="input-group">
                <label>Password</label>
                <input type="text" name="password_1">
            </div>
            <div class="input-group">
                <label>Confirm Password</label>
                <input type="text" name="password_2">
            </div>
            <div class="input-group">
                <button type="submit" name="register" class="button">Register</button>
            </div>
            <p>
                Already registered? <a href="login.php">Sign in</a>
            </p>
        </form>
    </body>
</html>
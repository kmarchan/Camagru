<!DOCTYPE html>
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
        <form method="post" action="register.php">
            <div class="input-group">
                <label>Username</label>
                <input type="text" name="Username">
            </div>
            <div class="input-group">
                <label>Password</label>
                <input type="text" name="password">
            </div>
            <div class="input-group">
                <button type="submit" name="login" class="button">Login</button>
            </div>
            <p>
                New here? <a href="register.php">Sign up</a>
            </p>
        </form>
    </body>
</html>
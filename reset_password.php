<!DOCTYPE html>
<?php include('server.php');?>
<html>
    <head>
        <title>Password reset</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>

    <body>
        <?php include_once("header.php")?>
        <div class="header" id="head">
            <h2>Reset Password</h2>
        </div>
        <form method="post" action="  " id="reg">
        <?php include('errors.php');?>
            <div class="input-group">
                <label>Recovery Email</label>
                <input type="email" name="email" pattern="[^()/><\][\\\x22,;|]+">
            </div>
            <div class="input-group">
                <button type="submit" name="recover" class="button">Send Email</button>
            </div>
        </form>
    </body>
</html>

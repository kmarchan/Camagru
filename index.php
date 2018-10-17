<?php include('server.php');?>
<!DOCTYPE html>
<html>
    <head>
        <title>Home</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>

    <body>
        <?php include_once("header.php")?>
        <div class="content">
            <?php if (isset($_SESSION['success'])): ?>
                <div class="error success">
                   <h3>
                        <?php
                            echo $_SESSION['success'];
                            unset($_SESSION['success']);
                        ?>
                   </h3> 
                </div>
                <?php endif?>
                <?php if (isset($_SESSION["username"])): ?>
                    <p>Welcome <strong><?php echo $_SESSION['username'] ?></strong></p>
                    <p><a href="" style="color: red;">Log out</a></p>
                <?php endif?>
        </div>
    </body>
</html>
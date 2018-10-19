<?php include('server.php');?>
<!DOCTYPE html>
<html>
    <head>
        <title>Home</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>

    <body>
        <?php include_once("header.php")?>
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
        <div class="content">

        </div>
    </body>
</html>

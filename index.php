<?php include('server.php');?>
<!DOCTYPE html>
<html>
    <head>
        <title>Home</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <style>
            button, camera {
                background-color: #EFCE5B;
                border-radius: 100%;
                padding: 10px;
                box-shadow: 10px 5px 10px lightgoldenrodyellow inset;
            }
        </style>
    </head>
    <body>
        <?php include_once("header.php")?>
        <div class="content">
        <?php if (isset($_SESSION['error'])): ?>
                <div id="error" style="color:red">
                   <h3>
                        <?php
                            echo $_SESSION['error'];
                            unset($_SESSION['error']);
                        ?>
                   </h3>
                </div>
                <?php endif?>
        <?php if (isset($_SESSION['message'])): ?>
                <div id="success" style="color:green">
                   <h3>
                        <?php
                            echo $_SESSION['message'];
                            unset($_SESSION['message']);
                        ?>
                   </h3>
                </div>
                <?php endif?>
            <?php if (isset($_SESSION['success'])): ?>
                <div id="success" style="color:green">
                   <h3>
                        <?php
                            echo $_SESSION['success'];
                            unset($_SESSION['success']);
                        ?>
                   </h3>
                </div>
                <?php endif?>
                <button class="camera">
                    <img src="camera.png" alt="shoot" height="30px">
                </button>
       </div>
    </body>
</html>

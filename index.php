<?php include('server.php');?>
<!DOCTYPE html>
<html>
    <head>
        <title>Home</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <style>
            .modal {
                display: none; 
                position: fixed; 
                z-index: 1;
                padding-top: 100px;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%; 
                overflow: auto; 
                background-color: rgb(0,0,0);
                background-color: rgba(0,0,0,0.4);
            }

            .modal-content {
                color: #1F2C34;
                background: #C7C3C2;
                border: 2px solid #EFCE5B;
                border-radius: 30px;
                padding: 2%;
                box-shadow: 10px 5px 20px #EFCE5B inset;
                background-color: #fefefe;
                margin: auto;
                padding: 20px;
                border: 1px solid #888;
                width: 65%;
            }

            .close {
                color: #aaaaaa;
                float: right;
                font-size: 28px;
                font-weight: bold;
            }

            .close:hover,
            .close:focus {
                color: #000;
                text-decoration: none;
                cursor: pointer;
            }
        </style>

    </head>
    <body>
        <?php include_once("header.php")?>
        <table width="100%">
            <tr>
                <td width="75%" valign="top">
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
                        <div>
                            <?php include("populate.php")?>
                            <div id="myModal" class="modal">
                                <div  class="modal-content">
                                    <span class="close">&times;</span>

                                    <img style="width: 100%" id="img01" style="margin: auto">
                                    <div class="header" id="head">
                                        <h2>Like and Comment</h2>
                                    </div>
<!--                                    --><?php //include_once ("./config/database.php");
//                                        $query = $db->prepare("SELECT * FROM camagru_db.comments WHERE `id` LIKE 'img01.src' ORDER BY sub_datetime DESC ");
//                                        $query->execute();
//                                        $res = $query->fetchAll();
//                                        foreach ($res as $tmp) {
//                                           $info = $tmp;
//                                           $data = $info['comment'];
//
//                                           echo "<p class='comment'>: ";
//                                    }
//                                    ?>
                                    <form method="post" action="index.php">
                                        <textarea hidden name="base64" id="imgsrc"></textarea>
                                        <button onclick="likePic(this.src)" name="likePic" class="button">Like</button>
                                        <input type="text" name="comment" pattern="[^()/><\][\\\x22,;|]+" title="No special characters wil be accepted" placeholder="Your Comment here">
                                        <button type="submit" class="button">Comment</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <script>
                            function openmodal(clickedID)
                            {
                                var modal = document.getElementById('myModal');
                                var img = document.getElementById(clickedID);
                                var modalImg = document.getElementById('img01');
                                var formimg = document.getElementById('imgsrc');
                                modal.style.display = "block";
                                modalImg.src = img.src;
                                modalImg.alt = img.id;
                                formimg.value = img.src

                                var span = document.getElementsByClassName("close")[0];
                                span.onclick = function()
                                {
                                    modal.style.display = "none";
                                }
                            }
                        </script>
                    </div>
                </td>

            </tr>
        </table>
        <div class="header">
          <?php if (isset($_SESSION["username"])): ?>
            <a href="image_edit.php"><img src="camera.png" height="100px"></a>
          <?php endif?>
        </div>
    </body>
</html>

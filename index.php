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

                                    <img style="width: 100%" id="img01" style="margin: auto" ondblclick="likeImg(this.id)">
                                    <div class="header" id="head">
                                        <h2>Like and Comment</h2>
                                    </div>

                                    <form method="post" action="index.php">
                                        <div id="comments">
                                            <?php include ('server.php')?>
                                        </div>
                                        <textarea hidden name="base64" id="imgsrc"></textarea>
                                        <input type="text" name="comment" pattern="[^()/><\][\\\x22,;|]+" title="No special characters wil be accepted" placeholder="Your Comment here">
                                        <button type="submit" class="button">Comment</button>
                                    </form>
                                    <form method="post" action="index.php">
                                      <textarea hidden name="del_id" id="imgid"></textarea>
                                      <button type="submit">delete</button>
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
                                var del = document.getElementById('imgid');
                                console.log(img.id);
                                modal.style.display = "block";
                                modalImg.src = img.src;
                                // modalImg.id = img.src;
                                modalImg.alt = img.id;
                                formimg.value = img.id;
                                del.value = img.id;

                                var comment = document.getElementById("comments");
                                var xhr = new XMLHttpRequest();
                                var url = "server.php";

                                var vars = "comment_id="+img.id;
                                xhr.open("POST", url, true);
                                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                                xhr.onreadystatechange = function()
                                {
                                    if (xhr.readyState == 4 && xhr.status == 200)
                                    {
                                        var return_data = xhr.responseText;
                                        document.getElementById("comments").innerHTML = return_data;
                                    }
                                }
                                xhr.send(vars);
                                document.getElementById("comments").innerHTML = "testing";

                                var span = document.getElementsByClassName("close")[0];
                                span.onclick = function()
                                {
                                    modal.style.display = "none";
                                }
                            }

                            function likeImg(clickedID) {
                                var modal = document.getElementById('myModal');
                                var img = document.getElementById(clickedID);
                                var modalImg = document.getElementById('img01');

                                var img_id = modalImg.alt;

                                var xhr = new XMLHttpRequest();
                                var url = "server.php";

                                var vars = "like_id="+img.alt;
                                xhr.open("POST", url, true);
                                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                                xhr.onreadystatechange = function()
                                {
                                    if (xhr.readyState == 4 && xhr.status == 200)
                                    {
                                        var return_data = xhr.responseText;
                                        document.getElementById("comments").innerHTML = return_data;
                                    }
                                }
                                xhr.send(vars);
                                window.location = 'index.php';

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

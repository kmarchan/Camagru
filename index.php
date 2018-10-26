<?php include('server.php');?>
<!DOCTYPE html>
<html>
    <head>
        <title>Home</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <style>
            #container {
                margin: 0px auto;
                /* width: 70%; */
                /* height: 60%; */
                border: 3px #1F2C3 solid;
            }
            #videoElement {
                /* width: 70%; */
                /* height: 60%; */
                /* height: 375px; */
                background-color: #666;
            }
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
        <table name="main" width="100%">
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
                        <div id="container">
                            <video autoplay="true" id="videoElement">
                        
                            </video>
                        </div>
                        <br>
                        <button class="camera" align="centre">
                            <img src="camera.png" alt="shoot" height="30px">
                        </button>
                        <script>
                            var video = document.querySelector("#videoElement");

                            if (navigator.mediaDevices.getUserMedia)
                            {       
                                navigator.mediaDevices.getUserMedia({video: true})
                                .then(function(stream) {video.srcObject = stream;})
                                .catch(function(err0r) {console.log("Something went wrong!");});
                            }
                        </script>
                    </div>
                </td  >
                <td width="25%" valign="top" >
                    <div class="content" height="100%">

                </div>
                </td>
            </tr>
        </table>
    </body>
</html>

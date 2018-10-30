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
                border: 3px;
            }
            #videoElement {
                /* width: 70%; */
                /* height: 60%; */
                /* height: 375px; */
                background-color: #666;
            }
            .button, .camera {
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
                            <video autoplay="true" id="videoElement"></video>
                        </div>
                        <br>
                        <button type="submit" name="" onclick="upload()" class="camera" align="centre" title="Save">
                            <img src="upload.png" alt="upload" height="30px">
                        </button>
                        <button type="submit" name="snapshot" onclick="snapshot()" class="camera" align="centre" title="Snapshot">
                            <img src="camera.png" alt="shoot" height="30px">
                        </button>
                        <button type="submit" name="" onclick="sticker()" class="camera" align="centre" title="Save">
                            <img src="save.png" alt="save" height="30px">
                        </button>

                    </div>
                </td>
                <td width="25%" valign="top" >
                    <div id="side" class="content" height="100%" name="side">
                        <h2>Snapshots</h2>
                        <div class="" id="snp">
                            <!-- <img src="camera.png" class="img" alt="img" id="img" height="100px"> -->
                        </div>
                    </div>
                </td>
                <script>
                    var video = document.querySelector("#videoElement");
                    // var img = document.createElement('img');

                    if (navigator.mediaDevices.getUserMedia)
                    {
                        navigator.mediaDevices.getUserMedia({video: true})
                            .then(function(stream)
                            {
                                video.srcObject = stream;
                                return video.play();
                            })

                    }
                    function snapshot()
                    {
                        var img = document.createElement('img');
                        var context;
                        var width = video.offsetWidth
                            , height = video.offsetHeight;
                        var can;
                        // if (canvas)
                        //     canvas = canvas;
                        // else
                        can = document.createElement("canvas");
                        can.width = width;
                        can.height = height;
                        context = can.getContext('2d');
                        context.drawImage(video, 0, 0, width, height);
                        img.src = can.toDataURL('image/png');

                        img.setAttribute("height", "100");
                        snp.insertBefore(img, snp.firstChild);
                        img.addEventListener("click", del);
                    }

                    function sticker()
                    {
                        var x = document.createElement("img");
                        x.setAttribute("src", "camera.png");
                        x.setAttribute("width", "100");
                        x.setAttribute("height", "100");
                        x.setAttribute("alt", "The Pulpit Rock");
                        document.body.appendChild(x);
                        // document.getElementById('canvas').appendChild(x);

                        snp.insertBefore(x, snp.firstChild);
                        // container.insertBefore(x, container.firstChild);

                        x.addEventListener("click", del);
                    }
                    function del()
                    {
                        if (confirm("Delete Photo?")) {
                            this.parentElement.removeChild(this);
                        }
                    }
                </script>
            </tr>
        </table>
        <div class="header">
            <img src="camera.png" height="100px">
        </div>
    </body>
</html>

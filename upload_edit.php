<?php include('server.php');?>
<!DOCTYPE html>
<html>
    <head>
        <title>upload</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <style>
            #container {
                position: relative;
                margin: 0px auto;
                /* width: 70%; */
                /* height: 60%; */
                border: 3px;
            }
            #videoElement {
                background-color: #666;
                /*margin: auto;*/
            }
            .button, .camera {
                background-color: #EFCE5B;
                border-radius: 100%;
                padding: 10px;
                box-shadow: 10px 5px 10px lightgoldenrodyellow inset;
            }
            .overlayImage
            {
            	/*position: absolute;*/
            	object-fit: contain;
                z-index: 100;

                width: 100%;
            	height: 100%;
            }
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
                margin: auto;
                width: 80%;
                color: #1F2C34;
                background: #C7C3C2;
                text-align: center;
                border-radius: 30px;
                padding: 20px;
                border: 2px solid #EFCE5B;
                box-shadow: 10px 5px 20px #EFCE5B inset;
            }
            .close {
                color: #aaaaaa;
                float: right;
                font-size: 28px;
                font-weight: bold;
            }
            #myCanvas {
                position: absolute;
                top: 0;
                left: 0;
                z-index: 10;
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
                            <canvas id="myCanvas" height="500" width="666"></canvas>
                            <div id="myImage" height="500" width="666"></video>
                        </div>
                        <br>
                        <a href="image_edit.php">
                          <button  class="camera" align="centre">
                            <img src="camera.svg" alt="upload" height="30px">
                          </button>
                        </a>
                        <button type="submit" name="snapshot" onclick="snapshot()" class="camera" align="centre" title="Snapshot">
                            <img src="camera.png" alt="shoot" height="30px">
                        </button>
                    </div>
                    <div id="myModal" class="modal">
                      <div class="modal-content">
                        <span class="close">&times;</span>
                        <p>Some text in the Modal..</p>
                    </div>
                </td>
                <td width="25%" valign="top" >
                    <div id="side" class="content" height="100%" name="side">
                        <h2>Snapshots</h2>
                        <div id="status"></div>
                        <div class="" id="snp">
                            <!-- <img src="camera.png" class="img" alt="img" id="img" height="100px"> -->
                        </div>
                    </div>
                </td>
                <script>


                    var width = 0, height = 0;

                    var canvas = document.getElementById('myCanvas'),

                    ctx = canvas.getContext('2d');
                    document.getElementById("container").appendChild(canvas);

                    function snapshot()
                    {
                        var img = document.createElement('img');
                        var context;
                        var width = video.offsetWidth
                            , height = video.offsetHeight;
                        var can;
                        can = document.createElement("canvas");
                        can.width = width;
                        can.height = height;
                        context = can.getContext('2d');
                        context.drawImage(video, 0, 0, width, height);
                        context.drawImage(myCanvas, 0, 0, width, height);
                        img.src = can.toDataURL('image/png');
                        img.setAttribute("height", "100");
                        console.log(img.src);
                        snp.insertBefore(img, snp.firstChild);

                        img.addEventListener("click", save);
                    }

                    function save()
                    {
                      if (confirm("Save Photo?"))
                      {
                          var xhr = new XMLHttpRequest();
                          var url = "server.php";
                          var usr = '<?php echo $_SESSION["username"]; ?>'
                          var pic = (encodeURIComponent(JSON.stringify(this.src)));
                          var vars = "username="+usr+"&pic="+pic+"&save=true";
                          console.log (vars);
                          xhr.open("POST", url, true);
                          xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                          xhr.onreadystatechange = function()
                          {
                              if (xhr.readyState == 4 && xhr.status == 200)
                              {
                                  var return_data = xhr.responseText;
                                  document.getElementById("status").innerHTML = return_data;
                              }
                          }
                      }
                      xhr.send(vars);
                      document.getElementById("status").innerHTML = "testing";
                    }

                </script>
            </tr>
        </table>
        <div class="header">
            <img height="100" src="./stickers/branches.png" alt="branches" onclick="addSticker('./stickers/branches.png')" value="Add">
            <img height="100" src="./stickers/bullets.png" alt="bullets" onclick="addSticker('./stickers/bullets.png')" value="Add">
            <img height="100" src="./stickers/butterfly.png" alt="butterfly" onclick="addSticker('./stickers/butterfly.png')" value="Add">
            <img height="100" src="./stickers/Gorgosaurus.png" alt="dino" onclick="addSticker('./stickers/Gorgosaurus.png')" value="Add">
            <img height="100" src="./stickers/water.png" alt="water" onclick="addSticker('./stickers/water.png')" value="Add">
            <script>
            function addSticker(loc)
            {
                var canvas = document.getElementById("myCanvas");
                var ctx = canvas.getContext("2d");

                var img = new Image();
                img.src = loc;

                console.log(loc);

                var hRatio = img.width / canvas.width ;
                var vRatio = img.height / canvas.height ;
                var ratio  = Math.min ( hRatio, vRatio );

                ctx.drawImage(img, 0,0, canvas.width, canvas.height);
            }
            </script>
        </div>
    </body>
</html>

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
            .overlayImage
            {
            	position: absolute;
            	object-fit: contain;

            	width: 60%;
            	height: 60%;
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
                        <button type="submit" name="save" onclick="sticker()" class="camera" align="centre" title="Save">
                            <img src="save.png" alt="save" height="30px">
                        </button>
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
                        //var id = <?php //rand(); ?>//;
                        can = document.createElement("canvas");
                        can.width = width;
                        can.height = height;
                        context = can.getContext('2d');
                        context.drawImage(video, 0, 0, width, height);
                        img.src = can.toDataURL('image/png');

                        img.setAttribute("height", "100");
                        snp.insertBefore(img, snp.firstChild);
                        // img.addEventListener("dblclick", del);
                        img.addEventListener("click", save);
                        console.log (img);
                    }

                    function sticker()
                    {
                        var x = document.createElement("img");

                        x.setAttribute("src", "camera.png");
                        x.setAttribute("width", "100");
                        x.setAttribute("height", "100");
                        x.setAttribute("alt", "The Pulpit Rock");
                        document.body.appendChild(x);
                        snp.insertBefore(x, snp.firstChild);

                        // x.addEventListener("dblclick", del);
                        x.addEventListener("click", save);
                    }
                    function del()
                    {
                        if (confirm("Delete Photo?")) {
                            this.parentElement.removeChild(this);
                        }
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
                      // xhttp.open("GET", "xmlhttp_info.txt", true);
                      xhr.send(vars);
                      document.getElementById("status").innerHTML = "testing";
                    }
                </script>
            </tr>
        </table>
        <div class="header">
            <!-- <img src="camera.png" height="100px"> -->
            <img height="100" src="./stickers/branches.png" alt="branches" onclick="addSticker('./stickers/branches.png')" value="Add">
            <img height="100" src="./stickers/bullets.png" alt="bullets" onclick="addSticker('./stickers/bullets.png')" value="Add">
            <img height="100" src="./stickers/butterfly.png" alt="butterfly" onclick="addSticker('./stickers/butterfly.png')" value="Add">
            <img height="100" src="./stickers/Gorgosaurus.png" alt="dino" onclick="addSticker('./stickers/Gorgosaurus.png')" value="Add">
            <img height="100" src="./stickers/water.png" alt="water" onclick="addSticker('./stickers/water.png')" value="Add">
            <script>
            function addSticker(loc)
            {
                var info = "test";
                console.log(info);
                var sticker = document.createElement('img');

                sticker.setAttribute("src", loc);
                sticker.setAttribute("alt", loc);
                sticker.setAttribute("class", 'overlayImage');
                container.insertBefore(sticker, container.firstChild);
            }
            </script>
        </div>
    </body>
</html>

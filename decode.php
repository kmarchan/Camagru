<!-- <?php include('server.php'); ?> -->
<?php
$data = $_SESSION['image_tmp'];
$type = $_SESSION['image_type'];
$ret = "<img id='userimage' style='width: 70%; height: 100%; object-fit: contain; display: none;' alt=Embedded Image src=\"data:".$type.";base64,".$data."\" />";
echo $ret;
?>


<?php
include_once ("./config/database.php");
$query = $db->prepare("SELECT * FROM camagru_db.images");
$query->execute();
$res = $query->fetchAll();
foreach ($res as $tmp) {
    $info = $tmp;
    $data = $info['pic'];

    echo "<img id='$id' class='userimage' style='width: 100%; object-fit: contain' src=$data>";
}
    ?>


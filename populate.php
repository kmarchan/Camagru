

<?php
include_once ("./config/database.php");
$query = $db->prepare("SELECT * FROM camagru_db.images ORDER BY sub_datetime DESC");
$query->execute();
$res = $query->fetchAll();
$id = 0;
foreach ($res as $tmp) {
    $info = $tmp;
    $data = $info['pic'];
    $id++;

    echo "<img class='userimage' id=$id style='width: 50%; object-fit: contain' src=$data onclick='openmodal(this.id)'>";
}
?>

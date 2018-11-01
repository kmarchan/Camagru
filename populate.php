

<?php
include_once ("./config/database.php");
$query = $db->prepare("SELECT * FROM camagru_db.images ORDER BY sub_datetime DESC");
$query->execute();
$res = $query->fetchAll();
// $id = $_SESSION['username'];
foreach ($res as $tmp) {
    $info = $tmp;
    $data = $info['pic'];

    echo "<img class='userimage' style='width: 50%; object-fit: contain' src=$data>";
}
    ?>

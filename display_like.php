<?php include ('server.php')?>

<?php
//    $comment_id = $_POST['comment_id'];
    $comment_id = 4;
    $db = new PDO("mysql:host=$servername;dbname=$dbname", $ad_username, $ad_password, $opt);
    $sql = $db->prepare("SELECT * FROM camagru_db.likes WHERE image_id = :src");
    $sql->execute(["src"=>$comment_id]);
    $result = $sql->fetchAll();

    echo "likes = count($result) <br />";
?>
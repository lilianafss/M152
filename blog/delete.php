<?php
ob_start();
require("./fonctionsBdd.php");
session_start();
$folder = "uploads/";
$idDuPost = $_SESSION['idDuPost'];
$suppresion = false;

if ($suppresion == false) {
    $nomMedia = selectMedia($idDuPost);
    $unlink = false;
    foreach ($nomMedia as $media) {
        if (!unlink($folder . $media['nomMedia']))
            $unlink = true;
    }
    if (!$unlink) {
        deletePost($idDuPost);
    }
    ob_end_clean();

    echo 1;
}else{
    echo 0;
}

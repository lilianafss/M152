<?php
ob_start();
require("./fonctionsBdd.php");
session_start();

$folder = "uploads/";

$idDuPost = $_SESSION['idDuPost'];
$suppresion = false;

$nomMedia = selectMedia($idDuPost);
$unlink = false;


foreach ($nomMedia as $media) {
    /* Vérifie si le fichier est pas supprimé du dossier*/
    if (!unlink($folder . $media['nomMedia'])) {
        $unlink = true;
    }
}
/* Suppression du post de la base de données. */
if (!$unlink) {
    deletePost($idDuPost);
}
ob_end_clean();

echo 1;
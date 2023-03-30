<!-- 
    Projet: Blog
    Auteur : Liliana Santos
    Description : Faire une publication
-->
<?php

require("fonctionsBdd.php");
$submit = filter_input(INPUT_POST, 'publier');
$description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);

//tailles fichiers
$totalFilesSize = 0;
$maxFileSize = 3 * 1024 * 1024;
$allFilesSize = 70 * 1024 * 1024;

$imageType = array('jpg', 'png', 'jpeg', 'gif','mp4','mp3');
$folder = "uploads/";
$errorMessage = [];


if ($submit == "Publier") {
    getConnexion()->beginTransaction();

    try {
        /* Vérifier si la description est vide ou non. */
        if (!empty($description)) {


            $idPost = newPost($description);

            /* selection de l'image */
            include("./ajoutImage.php");

            if (count($errorMessage) != 0) {
                //gerer les fautes utilisateur
                getConnexion()->rollBack();
            } else {
                getConnexion()->commit();
                header('Location:index.php');
                exit;
            }
        } else {
            $errorMessage[] = "Ajouter une description";
        }
      $_REQUEST['error']=$errorMessage;

    } catch (Exception $e) {
        //gerer les exception
        getConnexion()->rollBack();
        throw $e;
    }
}
require "./post.php";
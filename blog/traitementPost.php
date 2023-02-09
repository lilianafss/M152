<!-- 
    Projet: Blog
    Auteur : Liliana Santos
    Date: 26.01.2023
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

$imageType = array('jpg', 'png', 'jpeg', 'gif');
$folder = "/var/www/html/M152/blog/uploads/";

$idPost = newPost($description);
$error = "";

if ($submit == "Publier") {
    
   /* Filtrage du nom du fichier. */
    $nameFile = array_filter($_FILES['file']['name']);

    /* Il vérifie si le fichier est vide. */
    if (!empty($nameFile)) {

        /* Calcul de la taille totale de tous les fichiers. */
        for ($i = 0; $i < count($_FILES['file']['name']); $i++) {
            $file = $_FILES['file'];
            $totalFilesSize += $file['size'][$i];
        }

        /* Vérifier si la taille totale de tous les fichiers est inférieure à la taille maximale */
        if ($totalFilesSize <= $allFilesSize) {

            foreach ($nameFile as $key => $val) {

                /* Vérifier si la taille du fichier est inférieure à la taille maximale du fichier. */
                if ($file['size'][$key] <= $maxFileSize) {

                   /* Obtenir le nom du fichier. */
                    $nameFile = basename($nameFile[$key]);

                    /* Obtenir l'extension du fichier. */
                    $typeOfFile = pathinfo($nameFile, PATHINFO_EXTENSION);

                    if (in_array($typeOfFile, $imageType)) {

                        $fileName = pathinfo($nameFile);

                        $singleFileName = $fileName['filename'] . '_' . uniqid() . '.' . $fileName['extension'];

                        $filePath = $folder . $singleFileName;
                        
                        if (move_uploaded_file($_FILES["file"]["tmp_name"][$key], $filePath)) {
                            newMedia($typeOfFile, $singleFileName, $idPost);
                        }
                    }
                } else {
                    echo "trop grand";
                }
            }
        }

    }
}

require "./post.php";
<!-- 
    Projet: Blog
    Auteur : Liliana Santos
    Date: 26.01.2023
    Description : Faire une publication
-->
<?php

require("fonctionsBdd.php");
session_start();
$submit = filter_input(INPUT_POST, 'publier');
$description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);

//tailles fichiers
$totalFilesSize = 0;
$maxFileSize = 3 * 1024 * 1024;
$allFilesSize = 70 * 1024 * 1024;

$imageType = array('jpg', 'png', 'jpeg', 'gif');
$folder = "./uploads/";
$errorMessage = [];


if ($submit == "Publier") {
    getConnexion()->beginTransaction();

    try {
        /* Vérifier si la description est vide ou non. */
        if (!empty($description)) {


            $idPost = newPost($description);
            /* Filtrage du nom du fichier. */
            $nameFiles = array_filter($_FILES['file']['name']);

            /* Il vérifie si le fichier n'est vide. */
            if (!empty($nameFiles)) {

                /* Calcul de la taille totale de tous les fichiers. */
                for ($i = 0; $i < count($_FILES['file']['name']); $i++) {
                    $file = $_FILES['file'];
                    $totalFilesSize += $file['size'][$i];
                }

                /* Vérifier si la taille totale de tous les fichiers est inférieure à la taille maximale */
                if ($totalFilesSize <= $allFilesSize) {

                    foreach ($nameFiles as $key => $val) {
                        $file = $_FILES['file'];
                        /* Vérifier si la taille du fichier est inférieure à la taille maximale du fichier. */
                        if ($file['size'][$key] <= $maxFileSize) {

                            /* Obtenir le nom du fichier. */
                            $nameFile = basename($nameFiles[$key]);

                            /* Obtenir l'extension du fichier. */
                            $typeOfFile = pathinfo($nameFile, PATHINFO_EXTENSION);

                            if (in_array($typeOfFile, $imageType)) {

                                $fileName = pathinfo($nameFile);

                                $singleFileName = $fileName['filename'] . '_' . uniqid() . '.' . $fileName['extension'];

                                $filePath = $folder . $singleFileName;

                                /* Déplacer le fichier de l'emplacement temporaire vers le chemin du fichier. */
                                if (move_uploaded_file($_FILES["file"]["tmp_name"][$key], $filePath)) {
                                    if (file_exists($filePath)) {
                                        newMedia($_FILES["file"]["type"][$key], $singleFileName, $idPost);
                                       

                                    }

                                }

                            }
                            else{
                                $errorMessage[]="Le type de media n'est pas valide";
                            }
                        } else {
                            $errorMessage[] = "L'image est trop grand";
                        }
                    }
                } else {
                    $errorMessage[] = "Les images dépassent la limite de taille";
                }
            }
            if (count($errorMessage) != 0) {
                getConnexion()->rollBack();
            } else {
                getConnexion()->commit();
                header('Location:index.php');
                exit;
            }
        } else {
            $errorMessage[] = "Ajouter une description";
        }
       

    } catch (Exception $e) {
        getConnexion()->rollBack();
        throw $e;
    }
}
require "./post.php";
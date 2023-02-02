<!-- 
    Projet: Blog
    Auteur : Liliana Santos
    Date: 26.01.2023
    Description : Faire une publication
-->
<?php

require("fonctionsBdd.php");
$submit = filter_input(INPUT_POST, 'publier');
$maxFileSize = 3000000;
$imageType = array('jpg', 'png', 'jpeg', 'gif');
$erreur = "";

if ($submit == "Publier") {
    $folder = "/var/www/html/M152/blog/uploads/";
    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);

    $fileName = array_filter($_FILES['file']['name']);
    //$size = filesize($_FILES['file']['tmp_name']);

    if (!empty($fileName)) {
        foreach ($fileName as $key => $val) {
            $fileName = basename($fileName[$key]);
            $filePath = $folder . $fileName;

            $fileType = pathinfo($filePath, PATHINFO_EXTENSION);

            if (in_array($fileType, $imageType)) {
                move_uploaded_file($_FILES["file"]["tmp_name"][$key], $filePath);
            }

        }
    }
}

require "./post.php";
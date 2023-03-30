<?php
require("./fonctionsBdd.php");

session_start();
$id = $_SESSION['id'];
//tailles fichiers
$totalFilesSize = 0;
$maxFileSize = 3 * 1024 * 1024;
$allFilesSize = 70 * 1024 * 1024;

$imageType = array('jpg', 'png', 'jpeg', 'gif', 'mp4', 'mp3');
$folder = "uploads/";
$errorMessage = [];

$imagesCoches = array();
$posts = displayPostId($id);
$medias = selectMedia($id);


$commentaire = filter_input(INPUT_POST, 'commentaire', FILTER_SANITIZE_SPECIAL_CHARS);
$modification = filter_input(INPUT_POST, 'modifierPost');



if (isset($modification)) {
    getConnexion()->beginTransaction();

    try {
        if (!empty($commentaire)) {
            updatePost($commentaire, $id);
        } else {
            $errorMessage[] = "Ajouter une description";
        }

        if (isset($imagesCoches)) {
            $imagesCoches = $_POST['selectedMedia'];
        }

        $unlink = false;

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
                                    newMedia($_FILES["file"]["type"][$key], $singleFileName, $id);
                                }
                            }
                        } else {
                            $errorMessage[] = "Le type de media n'est pas valide";
                        }
                    } else {
                        $errorMessage[] = "Le media est trop grand";
                    }
                }
            } else {
                $errorMessage[] = "Les medias dépassent la limite de taille";
            }
        }
        if (count($errorMessage) != 0) {
            //gerer les fautes utilisateur
            getConnexion()->rollBack();
        } else {
            if (isset($imagesCoches)) {

                foreach ($imagesCoches as $media) {

                    if (!unlink($folder . $media)) {
                        $unlink = true;
                    }
                    if (!$unlink) {
                        deleteMedia($media);
                    }
                }
            }
            getConnexion()->commit();
            header('Location:index.php');
            exit;
        }
    } catch (Exception $e) {
        //gerer les exception
        getConnexion()->rollBack();
        throw $e;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/865258096d.js" crossorigin="anonymous"></script>
    <!-- css -->
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Editer un post</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a href="index.php" class="navbar-brand">M152 - Blog</a>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse1">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse1">
                <div class="navbar-nav">

                </div>
                <div class="d-flex ms-auto">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link text-white" href="./index.php"><i class="fa-solid fa-house"></i> Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="./post.php"><i class="fa-solid fa-plus"></i> Post</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link text-white" href=""><i class="fa-solid fa-user"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-5 align-items-center">

        <div class="row align-items-center">

            <form action="#" method="post" enctype="multipart/form-data">

                <div class="form-outline w-75">

                    <label for="textAreaLabel" class="form-label">Description du post :</label>
                    <?php foreach ($posts as $post) { ?>
                        <textarea class="form-control" id="textArea" placeholder="Message" rows="8" name="commentaire"><?= $post['commentaire'] ?></textarea>
                    <?php } ?>
                </div>
                <?php if (!empty($medias)) { ?>
                    <p>Selectionner les médias que vous voulez effacer :</p>
                    <?php foreach ($medias as $media) { ?>
                        <div class="col-md-3">
                            <div class="custom-control custom-checkbox image-checkbox">
                                <input type="checkbox" class="custom-control-input" id="media<?= $media['idMedia'] ?>" name="selectedMedia[]" value="<?= $media['nomMedia'] ?>">
                                <label class="custom-control-label" for="media<?= $media['nomMedia'] ?>">
                                    <?php if ($media['typeMedia'] == 'video/mp4') { ?>
                                        <video class="w-100 mb-3" autoplay loop muted>
                                            <source src="<?= $folder . $media["nomMedia"] ?>">
                                        </video>
                                    <?php } elseif ($media['typeMedia'] == 'audio/mpeg') { ?>
                                        <audio class="mb-3" controls>
                                            <source src="<?= $folder . $media["nomMedia"] ?>">
                                        </audio>
                                    <?php } else { ?>
                                        <img src="<?= $folder . $media['nomMedia'] ?>" class="card-img-top img-responsive mb-4">
                                    <?php } ?>
                                </label>
                            </div>
                            <input type="hidden" name="idMedia" value="<?= $media['idMedia'] ?>">
                        </div>
                <?php }
                } ?>
                <div class="form-outline w-75 mt-2 pt-1">
                    <label for="textAreaLabel" class="form-label">Ajouter un ou plusieurs fichiers :</label>
                    <input type="file" class="form-control" name="file[]" id="file" accept="image/jpg, image/png, image/jpeg, image/gif,video/mp4,audio/mp3" multiple>
                </div>

                <div class="d-grid col-6 w-75 mt-2 pt-1">
                    <input type="submit" value="Modifier" name="modifierPost" class="btn btn-primary p-2">
                </div>

            </form>

        </div>
    </div>

    <?php


    if (count($errorMessage) >= 1) { ?>

        <div class="alert alert-danger w-75 mt-3" role="alert">
            <?php foreach ($errorMessage as $key) {
                echo $key;
            } ?>
        </div>
    <?php }

    ?>
</body>

</html>
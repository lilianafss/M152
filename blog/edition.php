<?php
require("./fonctionsBdd.php");
session_start();
$id = $_SESSION['id'];
$folder = "uploads/";
$imagesCoches = array();
$posts = displayPostId($id);
$medias = selectMedia($id);
$commentaire = filter_input(INPUT_POST, 'commentaire', FILTER_SANITIZE_SPECIAL_CHARS);
$modification = filter_input(INPUT_POST, 'modifierPost');

if ($modification == "Modifier") {
    //updatePost($commentaire, $id);

    // header("Location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
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
                        <textarea class="form-control" id="textArea" placeholder="Message" rows="8"
                            name="commentaire"><?= $post['commentaire'] ?></textarea>
                    <?php } ?>
                </div>
                <?php if (!empty($medias)) { ?>
                    <div class="row">
                        <p class="form-label">Medias :</p>
                        <?php foreach ($medias as $media) { ?>
                            <div class="col-md-3">
                                <div class="custom-control custom-checkbox image-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="media<?= $media['idMedia'] ?>"
                                        name="selectedMedias[]" value="<?= $media['idMedia'] ?>">
                                    <label class="custom-control-label" for="media<?= $media['idMedia'] ?>">
                                        <img src="<?= $folder . $media['nomMedia'] ?>" class="card-img-top img-responsive mb-4">
                                    </label>
                                </div>
                            </div>
                            <?php
                        } ?>
                    </div>
                <?php } ?>
                <div class="form-outline w-75 mt-2 pt-1">
                    <label for="textAreaLabel" class="form-label">Ajouter un ou plusieurs fichiers :</label>
                    <input type="file" class="form-control" name="file[]" id="file"
                        accept="image/jpg, image/png, image/jpeg, image/gif,video/mp4,audio/mp3" multiple>
                </div>

                <div class="d-grid col-6 w-75 mt-2 pt-1">
                    <input type="submit" value="Modifier" name="modifierPost" class="btn btn-primary p-2">
                </div>

            </form>

        </div>
    </div>
   
    <script>
        var checked_medias = [];

        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        
        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].addEventListener('change', function () {
                var media_id = this.value;
                var media_src = document.querySelector('label[for="' + this.id + '"] img').src;

                if (this.checked) {
                    checked_medias.push(media_src);
                } else {
                    checked_medias.splice(checked_medias.indexOf(media_src), 1);
                }
            });
        }
    </script>

</body>

</html>
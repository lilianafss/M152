<!-- 
    Projet: Blog
    Auteur : Liliana Santos
    Date: 26.01.2023
    Description : Page inicial du blog
 -->
<?php
require("./fonctionsBdd.php");
session_start();
$suppresion = filter_input(INPUT_POST, 'supprimer');
$edition = filter_input(INPUT_POST, 'editer');
$idDuPost = filter_input(INPUT_POST, 'idDuPost');
$publish = displayPost();
$folder = "uploads/";


if ($suppresion == "Supprimer") {
    $nomMedia = selectMedia($idDuPost);
    $unlink = false;
    foreach ($nomMedia as $media) {
        if (!unlink($folder . $media['nomMedia']))
            $unlink = true;
    }
    if (!$unlink) {
        deletePost($idDuPost);
        header("refresh:0");
        exit;
    }
}

if ($edition == "Editer") {
    $_SESSION['id'] = $idDuPost;
    header("Location: edition.php");
}
?>
<!DOCTYPE html>
<html lang="fr">

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
    <!-- <link rel="stylesheet" href="./assets/css/style.css"> -->
    <title>Home</title>
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

    <div class="container d-flex h-100">
        <div class="row align-self-center">
            <div class="full col-sm-9">
                <div class="row">
                    <h1 class="text-center mt-3" id="msgBienvenue">Welcome</h1>
                    <!-- colonne gauche -->
                    <div class="col-sm-5">
                        <div class="card mt-5">
                            <img src="https://a.travel-assets.com/findyours-php/viewfinder/images/res70/475000/475457-Los-Angeles.jpg"
                                class="card-img-top img-responsive" alt="los angeles">
                            <div class="card-body">
                                <h5 class="card-title">Nom de votre blog</h5>
                                <p>45 Followers, 13 Posts</p>

                                <p>
                                    <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" height="28px"
                                        width="28px">
                                </p>
                            </div>
                        </div>

                        <div class="card mt-2">
                            <div class="card-header"><a href="#" class="float-end">View all</a>
                                <h4>Bootstrap Examples</h4>
                            </div>
                            <div class="card-body">
                                <div class="list-group">
                                    <p>Modal / Dialog</p>
                                    <p>Datetime Examples</p>
                                    <p>Data Grids</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- colonne droite -->
                    <div class="col-sm-7 mt-5">

                        <!-- C'est une boucle qui affichera tous les post. -->
                        <?php foreach ($publish as $key => $value) { ?>
                            <div class="card mb-3" id="cardPublication">
                                <form action="#" method="post">
                                    <?php
                                    /* Cette fonction compte le nombre de médias dans la base de données. */
                                    $countMedia = countMedia($value['idPost']);
                                    /* Cette fonction sélectionne tous les médias de la base de données. */
                                    $selectMedia = selectMedia($value['idPost']);

                                    if ($countMedia == 1) {
                                        ?>

                                        <?php
                                        /* Vérifie si le média est une vidéo, un son ou une image. */
                                        if ($selectMedia[0]['typeMedia'] == 'video/mp4') { ?>
                                            <video class="w-100" autoplay loop>
                                                <source src="<?= $folder . $selectMedia[0]['nomMedia'] ?>">
                                            </video>
                                        <?php } elseif ($selectMedia[0]['typeMedia'] == 'audio/mpeg') { ?>
                                            <audio class="w-100" controls>
                                                <source src="<?= $folder . $selectMedia[0]['nomMedia'] ?>">
                                            </audio>
                                        <?php } else { ?>
                                            <img src="<?php echo $folder . $selectMedia[0]['nomMedia'] ?>"
                                                class="card-img-top img-responsive">
                                        <?php } ?>

                                        <!-- Si le nombre de médias est supérieur ou égal à 2.  -->
                                    <?php } elseif ($countMedia >= 2) { ?>

                                        <?php /* Boucle qui affichera tous les médias. */
                                        foreach ($selectMedia as $media) {
                                            /* Vérifie si le média est une vidéo, un son ou une image. */
                                            if ($media['typeMedia'] == 'video/mp4') { ?>
                                                <video class="w-100 mb-3" autoplay loop muted>
                                                    <source src="<?= $folder . $media["nomMedia"] ?>">
                                                </video>
                                            <?php } elseif ($media['typeMedia'] == 'audio/mpeg') { ?>
                                                <audio class="w-100 mb-3" controls>
                                                    <source src="<?= $folder . $media["nomMedia"] ?>">
                                                </audio>
                                            <?php } else { ?>
                                                <img src="<?php echo $folder . $media["nomMedia"] ?>"
                                                    class="card-img-top img-responsive mb-3">
                                            <?php }
                                        } ?>


                                        <?php
                                    } ?>
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <?php echo $value["commentaire"] ?>
                                        </h5>
                                        <p>1,200 Followers, 83 Posts</p>
                                        <div class="float-end">
                                            <input type="submit" value="Editer" name="editer" class="btn btn-dark p-2">
                                            <input type="submit" value="Supprimer" name="supprimer"
                                                class="btn btn-dark p-2">
                                        </div>

                                    </div>
                                    <input type="hidden" id="idDuPost" name="idDuPost" value="<?= $value['idPost'] ?>">
                                </form>
                            </div>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<!-- 
    Projet: Blog
    Auteur : Liliana Santos
    Date: 26.01.2023
    Description : Page inicial du blog
 -->
<?php
require("./fonctionsBdd.php");
$publish = displayPost();
$folder = "uploads/";
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
                        <?php foreach ($publish as $key => $value) {
                            /* Cette fonction compte le nombre de médias dans la base de données. */
                            $countMedia = countMedia($value['idPost']);
                            /* Cette fonction sélectionne tous les médias de la base de données. */
                            $selectMedia = selectMedia($value['idPost']);
                            
                            if ($countMedia == 0) { ?>
                                <div class="card mb-3" id="cardPublication">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <?php echo $value["commentaire"] ?>
                                        </h5>
                                        <p>1,200 Followers, 83 Posts</p>
                                        <div class="float-end">
                                            <i class="fa-regular fa-pen-to-square p-2"></i>
                                            <i class="fa-solid fa-trash p-2"></i>
                                        </div>

                                    </div>
                                </div>
                            <?php } elseif ($countMedia == 1) {
                                ?>
                                <div class="card mb-3" id="cardPublication">
                                    <img src="<?php echo $folder . $selectMedia[0]["nomMedia"] ?>"
                                        class="card-img-top img-responsive">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <?php echo $value["commentaire"] ?>
                                        </h5>
                                        <p>1,200 Followers, 83 Posts</p>
                                        <div class="float-end">
                                            <i class="fa-regular fa-pen-to-square p-2"></i>
                                            <i class="fa-solid fa-trash p-2"></i>
                                        </div>

                                    </div>
                                </div>
                                <!-- Si le nombre de médias est supérieur ou égal à 2.  -->
                            <?php } elseif ($countMedia >= 2) { ?>
                                <div class="card mb-3" id="cardPublication">
                                    <?php /* Boucle qui affichera tous les médias. */
                                    foreach ($selectMedia as $media) { ?>
                                        <img src="<?php echo $folder . $media["nomMedia"] ?>" class="card-img-top img-responsive">
                                    <?php } ?>
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <?php echo $value["commentaire"] ?>
                                        </h5>
                                        <p>1,200 Followers, 83 Posts</p>
                                        <div class="float-end">
                                            <i class="fa-regular fa-pen-to-square p-2"></i>
                                            <i class="fa-solid fa-trash p-2"></i>
                                        </div>

                                    </div>
                                </div>
                            <?php
                                /* Il vérifie si c'est un video. */
                            } elseif ($value['typeMedia'] == "video/mp4") { ?>
                                <div class="card mb-3" id="cardPublication">
                                    <video width="320" height="240" controls autoplay loop>
                                        <source src="<?php $folder . $selectMedia[0]["nomMedia"] ?>" type="video/mp4">
                                    </video>
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <?php echo $value["commentaire"] ?>
                                        </h5>
                                        <p>1,200 Followers, 83 Posts</p>
                                        <div class="float-end">
                                            <i class="fa-regular fa-pen-to-square p-2"></i>
                                            <i class="fa-solid fa-trash p-2"></i>
                                        </div>

                                    </div>
                                </div>
                            <?php }

                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
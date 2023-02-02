<!-- 
    Projet: Blog
    Auteur : Liliana Santos
    Date: 26.01.2023
    Description : Faire une publication sur le blog
-->
<?php

require("./fonctionsBdd");
$submit = filter_input(INPUT_POST, 'publier', FILTER_SANITIZE_SPECIAL_CHARS);

if ($submit == "Publier") {

    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);
    $imageName = $_FILES['fichier[]']['name'];
    $imageType = $_FILES['fichier[]']['type'];
    $image = $_FILES['fichier[]']['tmp_name'];

    if ($description != "" && $image != "") {
        $img = file_get_contents($image);

        newPost($imageName, $imageType, $img);
    }
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
    <title>Post</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a href="#" class="navbar-brand">M152 - Blog</a>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse1">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse1">
                <div class="navbar-nav">

                </div>
                <div class="d-flex ms-auto">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link text-white" href="./home.html"><i class="fa-solid fa-house"></i> Home</a>
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

    <div class="card-footer py-3 border-0 m-5 " style="width: 50%;">
        <form action="#" method="post" enctype="multipart/form-data">
            <div class="form-outline w-100">
                <textarea class="form-control" id="textAreaExample" placeholder="Message" rows="5"
                    name="description"></textarea>
            </div>
            <div class="float-start mt-2 pt-1">
                <input type="file" name="fichier[]" id="fichier" accept="image/*" multiple>
            </div>
            <div class="float-end mt-2 pt-1">
                <input type="submit" value="Publier" name="publier" class="btn btn-primary btn-sm">
            </div>
        </form>
    </div>

</body>

</html>
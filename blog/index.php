<!-- 
    Projet: Blog
    Auteur : Liliana Santos
    Date: 26.01.2023
    Description : Page inicial du blog
 -->
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
                    <!-- colonne gauche -->
                    <div class="col-sm-5">
                        <div class="card mt-2">
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
                    <div class="col-sm-7">
                        <h1 class="text-center" id="msgBienvenue">Welcome</h1>
                        <div class="card" id="cardPublication">
                            <img src="https://d32ijn7u0aqfv4.cloudfront.net/wp/wp-content/uploads/raw/young-woman-walking-down-palm-trees-street-revealing-downtown-los-picture-id1143355576-1.jpg"
                                class="card-img-top img-responsive" alt="los angeles">
                            <div class="card-body">
                                <h5 class="card-title">Social Good</h5>
                                <p>1,200 Followers, 83 Posts</p>

                                <p>
                                    <img src="assets/images/photo.jpg" height="28px" width="28px">
                                    <img src="assets/images/photo.png" height="28px" width="28px">
                                    <img src="assets/images/photo_002.jpg" height="28px" width="28px">
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
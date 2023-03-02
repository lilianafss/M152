<!-- 
    Projet: Blog
    Auteur : Liliana Santos
    Date: 26.01.2023
    Description : Fonctions pour recuperer les données de la base de données 
 -->
<?php

require_once "./constantes.php";

/**
 * Il crée une connexion à une base de données MySQL 
 */
function getConnexion()
{
    static $myDb = null;

    if ($myDb === null) {
        try {
            $myDb = new PDO(
                "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8",
                DB_USER,
                DB_PASSWORD
            );
            $myDb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $myDb->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        } catch (PDOException $e) {
            die("Erreur :" . $e->getMessage());
        }
    }
    return $myDb;
}

/**
 * Il crée un nouveau média dans la base de données.
 */
function newMedia($typeMedia, $nameMedia, $idPost)
{
    $today = date("Y-m-d H:i:s");
    $myDb = getConnexion();
    try {
        $query = $myDb->prepare("
            INSERT INTO `media`(`typeMedia`, `nomMedia`, `creationDate`,`idPost`) 
            VALUES (?,?,?,?)
        ");
        $query->execute([$typeMedia, $nameMedia, $today, $idPost]);
    } catch (Exception $e) {
        echo "Failed: " . $e->getMessage();
    } 
}


/**
 * Il insère un nouveau message dans la base de données et renvoie l'identifiant du nouveau message
 */
function newPost($comment)
{
    $today = date("Y-m-d H:i:s");
    $myDb = getConnexion();
    try {
        $query = $myDb->prepare("
            INSERT INTO `post`(`commentaire`, `creationDate`, `modificationDate`) 
            VALUES (?,?,?)
        ");
        $query->execute([$comment, $today, $today]);
        return $myDb->lastInsertId();
    } catch (Exception $e) {
        echo "Failed: " . $e->getMessage();
    }
}

/**
 * Il obtient le commentaire et l'identifiant du message de la base de données et les classe par date de création
 */
function displayPost()
{
    try {
        $query = getConnexion()->prepare("
        SELECT `commentaire`,`idPost` 
        FROM `post`
        ORDER BY `creationDate` DESC;
        ");

        $query->execute([]);

        return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo 'Exception reçue : ', $e->getMessage(), "\n";
    }
}

/**
 * Il sélectionne le nom et le type de média associé à une publication.
 */
function selectMedia($idPost)
{
    try {
        $query = getConnexion()->prepare("
        SELECT `nomMedia`, `typeMedia`
        FROM `media`,`post` 
        WHERE `media`.`idPost`=`post`.`idPost` 
        AND `post`.`idPost` = ? 
        ");

        $query->execute([$idPost]);

        return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo 'Exception reçue : ', $e->getMessage(), "\n";
    }
}

/**
 * Il compte le nombre de médias dans une publication.
 */
function countMedia($idPost)
{
    try {
        $query = getConnexion()->prepare("
        SELECT COUNT(`idMedia`) 
        FROM `media`,`post` 
        WHERE `media`.`idPost`=`post`.`idPost` AND `post`.`idPost` = ?
        ");

        $query->execute([$idPost]);

        return $query->fetch(PDO::FETCH_NUM)[0];
    } catch (PDOException $e) {
        echo 'Exception reçue : ', $e->getMessage(), "\n";
    }
}
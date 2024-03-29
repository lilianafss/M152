<!-- 
    Projet: Blog
    Auteur : Liliana Santos
    Description : Fonctions pour recuperer les données de la base de données 
 -->
<?php

require_once "./constantes.php";

/**
 * Créer une connexion à une base de données MySQL 
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
 * Créer un nouveau média dans la base de données.
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
 * Insèrer un nouveau message dans la base de données et renvoie l'identifiant du nouveau message
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
 * Obtient le commentaire et l'identifiant du message de la base de données et les classe par date de création
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

function displayPostId($idPost)
{
    try {
        $query = getConnexion()->prepare("
        SELECT `commentaire`,`idPost` 
        FROM `post`
        WHERE `post`.`idPost` = ? 
        ");

        $query->execute([$idPost]);

        return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo 'Exception reçue : ', $e->getMessage(), "\n";
    }
}
/**
 * Sélectionner le nom et le type de média associé à une publication.
 */
function selectMedia($idPost)
{
    try {
        $query = getConnexion()->prepare("
        SELECT `idMedia`,`nomMedia`, `typeMedia`
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
 * Compter le nombre de médias dans une publication.
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

/**
 * Supprimer un message de la base de données.
 */
function deletePost($idPost)
{
    try {
        $query = getConnexion()->prepare("
        DELETE FROM `post` WHERE `idPost` = ?
        ");
        $query->execute([$idPost]);
    } catch (PDOException $e) {
        echo 'Exception reçue : ', $e->getMessage(), "\n";
    }
}

/**
 * Supprimer un media de la base de données.
 */
function deleteMedia($nomMedia)
{
    try {
        $query = getConnexion()->prepare("
        DELETE FROM `media` WHERE `nomMedia` = '$nomMedia'
        ");
        $query->execute([]);
    } catch (PDOException $e) {
        echo 'Exception reçue : ', $e->getMessage(), "\n";
    }
}

/**
 * Il met à jour le commentaire d'un post dans la base de données.
 */
function updatePost($commentaire, $idPost)
{
    try {
        $query = getConnexion()->prepare("
                UPDATE `post` 
                SET `commentaire`= ?
                WHERE `idPost` = ?
            ");
        $query->execute([$commentaire, $idPost]);
    } catch (Exception $e) {
        echo 'Exception reçue : ', $e->getMessage(), "\n";
    }
}


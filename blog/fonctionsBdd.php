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

    if($myDb === null)
    {
        try
        {
            $myDb = new PDO(
                "mysql:host=". DB_HOST. ";dbname=". DB_NAME. ";charset=utf8",
                DB_USER, DB_PASSWORD
            );
            $myDb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $myDb->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        }
        catch(PDOException $e)
        {
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
    $query = getConnexion()->prepare("
            INSERT INTO `media`(`typeMedia`, `nomMedia`, `creationDate`,`idPost`) 
            VALUES (?,?,?,?)
        ");
    $query->execute([$typeMedia, $nameMedia,$today,$idPost]);

}


/**
 * Il insère un nouveau message dans la base de données et renvoie l'identifiant du nouveau message
 */
function newPost($comment)
{
    $today = date("Y-m-d H:i:s");
    
    $myDb = getConnexion();
    $query = $myDb->prepare("
            INSERT INTO `post`(`commentaire`, `creationDate`, `modificationDate`) 
            VALUES (?,?,?)
        ");
    $query->execute([$comment,$today,$today]);
    return $myDb->lastInsertId();

}
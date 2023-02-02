<!-- 
    Projet: Blog
    Auteur : Liliana Santos
    Date: 26.01.2023
    Description : Fonctions pour recuperer les données de la base de données 
 -->
<?php

require_once "./constantes.php";

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

function newMedia($typeMedia, $nameMedia)
{
    $query = getConnexion()->prepare("
            INSERT INTO `media`(`typeMedia`, `nomMedia`, `creationDate) 
            VALUES (?, ?, DATE(NOW()), ?);
        ");
    $query->execute([$typeMedia, $nameMedia]);

}

function newPost($comment,$modificationDate)
{
    $query = getConnexion()->prepare("
            INSERT INTO `post`(`commentaire`, `creationDate`, `modificationDate`) 
            VALUES (?, DATE(NOW()),?);
        ");
    $query->execute([$comment,$modificationDate]);

}
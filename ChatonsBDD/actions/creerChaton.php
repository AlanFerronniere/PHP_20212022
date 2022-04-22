<?php
//vérification du token
session_start();
if ($_SESSION["token"] != filter_input(INPUT_POST, "token")) {
    die("vilain pirate");
}
else
    $_SESSION["token"]=uniqid();

$nom = filter_input(INPUT_POST, "nom");
$dateDeNaissance = filter_input(INPUT_POST, "dateDeNaissance");
$idCategorie = filter_input(INPUT_POST, "idCategorie");

$cheminDuFichierDeDestination="../Photos/".basename($_FILES["photo"]["name"]);
move_uploaded_file($_FILES["photo"]["tmp_name"], $cheminDuFichierDeDestination);

include_once "../config.php";
$pdo = new PDO("mysql:host=".Config::SERVEUR.";dbname=".Config::BDD, Config::UTILISATEUR, Config::MOTDEPASSE);
$req=$pdo->prepare("insert into chatons (nom, dateDeNaissance, id_categorie, photo) 
                            values (:nom, :dateDeNaissance, :id_categorie, :photo)");
$req->bindParam(":nom", $nom);
$req->bindParam(":dateDeNaissance", $dateDeNaissance);
$req->bindParam(":id_categorie", $idCategorie);
$req->bindValue(":photo", basename($_FILES["photo"]["name"]));

$req->execute();

//pour déboguer
//$req->debugDumpParams();

$id=$pdo->lastInsertId(); //récupère le dernier id généré

//je redirige vers la visualisation de ce dossier, comme si on avait utilisé le menu
header("location: ../categorie.php?id=$idCategorie");

<?php
//vérification du token
session_start();
if ($_SESSION["token"] != filter_input(INPUT_POST, "token")) {
    die("vilain pirate");
}
else
    $_SESSION["token"]=uniqid();

$titre = filter_input(INPUT_POST, "titre");
$description = filter_input(INPUT_POST, "description");

include_once "../config.php";
$pdo = new PDO("mysql:host=".Config::SERVEUR.";dbname=".Config::BDD, Config::UTILISATEUR, Config::MOTDEPASSE);
$req=$pdo->prepare("insert into categories (titre, description) values (:titre, :description)");
$req->bindParam(":titre", $titre);
$req->bindParam(":description", $description);

$req->execute();

//pour déboguer
//$req->debugDumpParams();

$id=$pdo->lastInsertId(); //récupère le dernier id généré

//je redirige vers la visualisation de ce dossier, comme si on avait utilisé le menu
header("location: ../dossier.php?id=$id");

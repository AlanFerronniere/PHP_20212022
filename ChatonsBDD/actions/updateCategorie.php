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
$id = filter_input(INPUT_POST, "id");

include_once "../config.php";
$pdo = new PDO("mysql:host=".Config::SERVEUR.";dbname=".Config::BDD, Config::UTILISATEUR, Config::MOTDEPASSE);
$req=$pdo->prepare("update categories set titre=:titre, description=:description where id=:id");
$req->bindParam(":titre", $titre);
$req->bindParam(":description", $description);
$req->bindParam(":id", $id);

$req->execute();

//pour déboguer
//$req->debugDumpParams();

//je redirige vers la visualisation de ce dossier, comme si on avait utilisé le menu
header("location: ../index.php");

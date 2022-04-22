<?php
//vérification du token
session_start();
if ($_SESSION["token"] != filter_input(INPUT_POST, "token")) {
    die("vilain pirate");
}
else
    $_SESSION["token"]=uniqid();

$id = filter_input(INPUT_POST, "id");

include_once "../config.php";
$pdo = new PDO("mysql:host=".Config::SERVEUR.";dbname=".Config::BDD, Config::UTILISATEUR, Config::MOTDEPASSE);
$req=$pdo->prepare("delete from categories where id=:id");
$req->bindParam(":id", $id);

$req->execute();

//pour déboguer
//$req->debugDumpParams();

//je redirige vers la visualisation de ce dossier, comme si on avait utilisé le menu
header("location: ../index.php");

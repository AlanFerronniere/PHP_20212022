<?php
//vérification du token
session_start();
if ($_SESSION["token"] != filter_input(INPUT_POST, "token")) {
    die("vilain pirate");
}
else
    $_SESSION["token"]=uniqid();

$d=filter_input(INPUT_POST, "d");
//je construis la destination
$destination="../Photos/$d";

//il faudrait vérifier que ce dossier existe

$cheminDuFichierDeDestination=$destination."/".basename($_FILES["fichier"]["name"]);

//il faudrait vérifier qu'une image avec ce nom n'existe pas déjà

//je bouge le fichier temporaire vers la bonne destination
move_uploaded_file($_FILES["fichier"]["tmp_name"], $cheminDuFichierDeDestination);

//je retourne à l'affichage du dossier
header("location: ../dossier.php?d=$d");
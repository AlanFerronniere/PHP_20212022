<?php
//vérification du token
session_start();
if ($_SESSION["token"] != filter_input(INPUT_POST, "token")) {
    die("vilain pirate");
}
else
    $_SESSION["token"]=uniqid();

$d = filter_input(INPUT_POST, "d");

//s'il n'existe pas déjà, je vais le créer
if (is_dir("../Photos/$d")) {
    rmdir("../Photos/$d");
}

//je redirige vers la visualisation de ce dossier, comme si on avait utilisé le menu
header("location: ../index.php");

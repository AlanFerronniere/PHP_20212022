<?php
//vérification du token
session_start();
if ($_SESSION["token"] != filter_input(INPUT_POST, "token")) {
    die("vilain pirate");
}
else
    $_SESSION["token"]=uniqid();

$d=filter_input(INPUT_POST, "d");
$image=filter_input(INPUT_POST, "image");

if (is_file("../Photos/$d/$image"))
    unlink("../Photos/$d/$image");

header("location: ../dossier.php?d=$d");
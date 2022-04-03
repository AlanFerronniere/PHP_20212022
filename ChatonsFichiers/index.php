<?php
session_start();
//je crée un anti-forgery token
$token=uniqid();
$_SESSION["token"]=$token;

$title="Gestion des chaton";
include "header.php";

?>
<h1>Bienvenue sur la gestion des chatons</h1>
<div class="container">
    <form method="post" action="actions/creerDossier.php">
        <h2>Ajouter un dossier</h2>
        <input type="text" required name="nomDuDossier">
        <input type="submit" value="OK">
        <input type="hidden" name="token" value="<?php echo $token ?>">
    </form>
</div>
<?php
include "footer.php";

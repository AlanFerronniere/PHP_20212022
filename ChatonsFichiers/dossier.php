<?php
session_start();
//je crée un anti-forgery token
$token = uniqid();
$_SESSION["token"] = $token;

//attention, on ne fait jamais d'echo d'une variable récupérée
//en get ou post. On l'enrobe de htmlentities ou htmlspecialchars
$d = filter_input(INPUT_GET, "d");

//testons l'existance du dossier
if (!is_dir("Photos/$d")) {
    //renvoyer une erreur 404
    http_response_code(404);
    die();
}

$title = "Les chatons du dossier $d";
include "header.php";


?>
    <h1>Les chatons du dossier <?php echo htmlentities($d) ?></h1>
    <div class="container">
        <div class="row">
            <?php
            //je vais chercher les images dans le dossier
            $images = scandir("Photos/$d");
            $afficherLaSuppression = true;
            foreach ($images as $image) {
                if ($image != "." && $image != ".."
                    && is_file("Photos/$d/$image")) {
                    $afficherLaSuppression = false;
                    ?>
                    <div class="col col-3">
                        <div class="card"><img src="<?php echo "Photos/$d/$image" ?>" alt="" class="card-img-top">
                            <div class="card-body">
                                <h5><?php echo $image
                                    ?></h5>
                                <form method="post" action="actions/supprimerChaton.php">
                                    <input type="hidden" name="token" value="<?php echo $token ?>">
                                    <input type="hidden" name="image" value="<?php echo $image ?>">
                                    <input type="hidden" name="d" value="<?php echo $d ?>">
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr ?')">
                                        supprimer
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            if ($afficherLaSuppression) {
                ?>
                <form method="post" action="actions/supprimerDossier.php">
                    Voulez-vous supprimer ce dossier ?
                    <button class="btn btn-danger" onclick="return confirm('Êtes-vous sûr ?')">supprimer</button>
                    <input type="hidden" name="d" value="<?php echo $d ?>">
                    <input type="hidden" name="token" value="<?php echo $token ?>">
                </form>
                <?php
            }
            ?>
        </div>
        <hr>
        <form action="actions/ajouterChaton.php" method="post" enctype="multipart/form-data">
            <h2>Ajouter un chaton</h2>
            <input type="file" required accept=".jpg,.gif,.png" name="fichier">
            <input type="hidden" name="d" value="<?php echo $d ?>">
            <input type="submit" value="OK">
            <input type="hidden" name="token" value="<?php echo $token ?>">
        </form>
    </div>
<?php
include "footer.php";
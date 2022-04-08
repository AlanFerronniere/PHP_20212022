<?php
session_start();
//je crée un anti-forgery token
$token = uniqid();
$_SESSION["token"] = $token;

$title = "Gestion des chaton";
include "header.php";

?>
    <div class="container">
        <h1>Modifier une catégorie</h1>

        <?php
        $id = filter_input(INPUT_GET, "id");

        //Allons chercher les valeurs existantes
        include_once "config.php";
        //création de la connexion à la BDD
        $pdo = new PDO("mysql:host=" . Config::SERVEUR . ";dbname=" . Config::BDD, Config::UTILISATEUR, Config::MOTDEPASSE);
        //création de la requete
        $req = $pdo->prepare("select * from categories where id=:id");
        $req->bindParam(":id", $id);

        //executer la requete
        $req->execute();
        //récupérer le résultat
        $lignes = $req->fetchAll();

        //on n'a rien trouvé
        if (count($lignes) != 1) {
            //renvoyer une erreur 404
            http_response_code(404);
            die();
        }

        $categorie = $lignes[0];

        ?>

        <div class="row">
            <div class="col-6">
                <form method="post" action="actions/updateCategorie.php">
                    <div class="form-group">
                        <label for="titre">Titre</label>
                        <input type="text" required name="titre" maxlength="100" class="form-control"
                               value="<?php echo htmlentities($categorie["titre"]) ?>">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea cols="80" rows="5" name="description"
                                  class="form-control"><?php echo htmlentities($categorie["description"]) ?></textarea>
                    </div>
                    <a href="index.php" class="mt-2 btn btn-danger">Annuler</a>
                    <input type="submit" value="OK" class="mt-2 btn btn-success">
                    <input type="hidden" name="token" value="<?php echo $token ?>">
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                </form>
            </div>
        </div>
    </div>
<?php
include "footer.php";

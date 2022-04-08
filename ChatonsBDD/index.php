<?php
session_start();
//je crée un anti-forgery token
$token = uniqid();
$_SESSION["token"] = $token;

$title = "Gestion des chaton";
include "header.php";

?>
    <div class="container">
        <h1>Bienvenue sur la gestion des chatons</h1>
        <h2>Voici les catégories</h2>
        <table class="table table-striped">
            <tr>
                <th>Titre</th>
                <th>Description</th>
                <th></th>
            </tr>
            <?php
            //Construire le tableau avec le contenu de la table catégories
            include_once "config.php";
            //création de la connexion à la BDD
            $pdo = new PDO("mysql:host=" . Config::SERVEUR . ";dbname=" . Config::BDD, Config::UTILISATEUR, Config::MOTDEPASSE);
            //création de la requete
            $req = $pdo->prepare("select * from categories");
            //executer la requete
            $req->execute();
            //récupérer le résultat
            $lignes = $req->fetchAll();

            foreach ($lignes as $l) {
                ?>
                <tr>
                    <td><?php echo htmlentities($l["titre"]) ?></td>
                    <td><?php echo htmlentities($l["description"]) ?></td>
                    <td>
                        <a href="modifierCategorie.php?id=<?php echo $l["id"] ?>" class="btn btn-success">modifier</a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
        <h2>Ajouter un catégorie</h2>
        <div class="row">
            <div class="col-6">
                <form method="post" action="actions/creerCategorie.php">
                    <div class="form-group">
                        <label for="titre">Titre</label>
                        <input type="text" required name="titre" maxlength="100" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea cols="80" rows="5" name="description" class="form-control"></textarea>
                    </div>
                    <input type="submit" value="OK" class="mt-2 btn btn-success">
                    <input type="hidden" name="token" value="<?php echo $token ?>">
                </form>
            </div>
        </div>
    </div>
<?php
include "footer.php";

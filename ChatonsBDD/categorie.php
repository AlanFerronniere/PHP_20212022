<?php
session_start();
//je crée un anti-forgery token
$token = uniqid();
$_SESSION["token"] = $token;

$title = "Gestion des chaton";
include "header.php";

?>
    <div class="container">
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
        <h1><?php echo htmlentities($categorie["titre"]) ?></h1>

        <div class="row">
            <?php
            include_once "config.php";
            $pdo = new PDO("mysql:host=" . Config::SERVEUR . ";dbname=" . Config::BDD, Config::UTILISATEUR, Config::MOTDEPASSE);
            $req = $pdo->prepare("select * from chatons where id_categorie=:id");
            $req->bindParam(":id", $id);

            //executer la requete
            $req->execute();
            //récupérer le résultat
            $lignes = $req->fetchAll();

            foreach ($lignes as $chaton) {
                ?>
                <div class="col col-3">
                    <div class="card"><img src="<?php echo "Photos/" . $chaton["photo"] ?>" alt="" class="card-img-top">
                        <div class="card-body">
                            <h5><?php echo htmlentities($chaton["nom"])
                                ?></h5>
                            <i><?php echo htmlentities($chaton["dateDeNaissance"]) ?></i>

                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>


        <h2>Ajouter un chaton</h2>
        <div class="row">
            <div class="col-6">
                <form method="post" action="actions/creerChaton.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="titre">Nom</label>
                        <input type="text" required name="nom" maxlength="100" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="titre">Date de naissance</label>
                        <input type="date" required name="dateDeNaissance" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="titre">Catégorie</label>
                        <select required name="idCategorie" class="form-control">
                            <?php
                            include_once "config.php";
                            $pdo = new PDO("mysql:host=" . Config::SERVEUR . ";dbname=" . Config::BDD, Config::UTILISATEUR, Config::MOTDEPASSE);
                            $req = $pdo->prepare("select id,titre from categories");
                            $req->execute();
                            $lignes = $req->fetchAll();

                            foreach ($lignes as $l) {
                                ?>
                                <option value="<?php echo $l["id"] ?>" <?php echo $id == $l["id"] ? "selected" : "" ?>><?php echo htmlentities($l["titre"]) ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="titre">Photo</label>
                        <input type="file" required name="photo" class="form-control">
                    </div>
                    <input type="submit" value="OK" class="mt-2 btn btn-success">
                    <input type="hidden" name="token" value="<?php echo $token ?>">
                </form>
            </div>
        </div>
    </div>
<?php
include "footer.php";

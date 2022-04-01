<?php
//attention, on ne fait jamais d'echo d'une variable récupérée
//en get ou post. On l'enrobe de htmlentities ou htmlspecialchars
$d=filter_input(INPUT_GET, "d");

//testons l'existance du dossier
if (!is_dir("Photos/$d")){
    //renvoyer une erreur 404
    http_response_code(404);
    die();
}

$title="Les chatons du dossier $d";
include "header.php";


?>
<h1>Les chatons du dossier <?php echo htmlentities($d) ?></h1>
    <div class="container">
        <div class="row">
            <?php
            //je vais chercher les images dans le dossier
            $images = scandir("Photos/$d");
            foreach ($images as $image){
                if ($image!="." && $image!=".."
                        && is_file("Photos/$d/$image")){
                    ?>
                    <div class="col col-3">
                        <div class="card"><img src="<?php echo "Photos/$d/$image" ?>" alt="" class="card-img-top">
                            <div class="card-body">
                                <h5><?php echo $image
                                    ?></h5>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>

<?php
include "footer.php";
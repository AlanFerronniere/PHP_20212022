<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Les bases</title>
</head>
<body>
    <?php
    //Commentaire
    /*
     * sur
     * *plusieurs lignes
     */

    //Variables
    $toto = 5;
    $toto="dlsflkmdskml";

    //Chaines de caractères
    $toto="Avec des guillements";
    $toto='Avec des apostrophes';
    //La différence est sur la concaténation
    $uneChaine='truc';
    $uneAutreChaine=$uneChaine.'<br>';
    $uneAutreChaine=$uneChaine."<br>";
    //Quand on est avec des guillemets
    $uneAutreChaine="$uneChaine<br>";

    //nom de variable dynamique
    $mavariable='uneChaine';
    echo $$mavariable; //ca va afficher $uneChaine

    //Les tableaux
    //En fait, ce sont plus des dictionnaires
    $tab1=array(3,7,9,5);
    $tab2=[3,7,9,5];
    //Et comme ce n'est pas typé
    $tab3=[3,"truc",2];
    echo $tab3[1]; //accède à la case d'index 1 "truc"

    //Déclaration plus découpée
    $tab4[0]="toto";
    $tab4[1]="titi";
    $tab4[]="tata"; //il trouvera tout seul l'index à faire
    $tab4["machin"] ="truc";
    $tab4[]="tutu";
    $tab4[200]="tutu";

    //Très utile pour le débugage
    var_dump($tab4);

    echo "<hr>";

    //Conditions
    if ($toto=="truc"){
        echo "toto est égal à truc";
    }
    else{
        echo "toto est n'égal pas à truc";
    }

    echo $toto=="truc"?"oui":"non";

    //Boucles

    for ($i=0;$i<10;$i++){
        echo "$i<br>";
    }
    echo "<hr>";
    $n=2;
    while($n<1000){
        echo "$n<br>";
        $n*=2;
    }
    echo "<hr>";

    //boucle pour les tableaux
    foreach ($tab1 as $value){
        echo "$value<br>";
    }
    echo "<hr>";
    foreach ($tab4 as $key=>$value){
        echo "$key : $value<br>";
    }

    //Fonctions
    function afficherBonjour(){
        echo "Bonjour<br>";
    }
    //appel d'une fonction
    afficherBonjour();

    echo "<hr>";
    function estDivisiblePar($nombre, $diviseur){
        return $nombre%$diviseur==0;
    }
    for ($i=0;$i<50;$i++)
        echo estDivisiblePar($i,3)?"$i est divisible pas 3<br>"
                                :"$i n'est pas divisible par 3<br>";


    echo "<hr>";

    function estPremier($nombre){
        if ($nombre<=3)
            return true;
        for ($i=2;$i<=sqrt($nombre);$i++)
             if($nombre%$i==0)
                 return false;

        return true;
    }

    echo "<table><tr>";
    for($i=1;$i<=20;$i++){
        echo "<td>";
        echo estPremier($i)?"<b>$i</b>":$i;
        echo "</td>";

        if ($i%5==0 && $i!=20)
            echo "</tr><tr>";
    }
    echo "</tr></table>";

    ?>
    <a href="exercice2.php?etages=9">Fais une pyramide à 9 étages</a>
    <!-- Commentaire -->
</body>
</html>
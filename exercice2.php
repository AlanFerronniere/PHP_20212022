<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Exercice 2 - Pyramides</title>
</head>
<body>
<?php
function triangle($etages){
    echo "<table>";

    for ($i=0;$i<$etages;$i++){
        echo "<tr>";
        for ($j=0;$j<$i+1;$j++)
            echo "<td>X</td>";
        echo "</tr>";
    }

    echo "</table>";
}


function pyramide($etages){
    echo "<table>";
    for ($i=0;$i<$etages;$i++)
    {
        echo "<tr>";

        //Les cases vides à gauche
        for ($j=0;$j<$etages-1-$i;$j++)
            echo "<td></td>";

        //les cases pleines
        $casePleine=true;
        for ($j=0;$j<($i+1)*2-1;$j++){
            echo $casePleine?"<td>&hearts;</td>":"<td></td>";
            $casePleine=!$casePleine;
        }

        echo "</tr>";
    }
    echo "</table>";
}

//triangle(10);
//récupération d'un paramètre en GET
//acienne méthode
//$etages=$_GET["etages"];
$etages=filter_input(INPUT_GET, "etages");
pyramide($etages);
?>
</body>
</html>

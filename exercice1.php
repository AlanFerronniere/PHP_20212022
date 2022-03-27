<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Exercice 1</title>
</head>
<body>
    <p>Afficher un tableau en 5 colonnes des entiers de 1 à 20, en mettant en gras les nombres premiers.

    <?php
    function estPremier($nombre){
        if($nombre<=1)
            return false;

        for($i=2;$i<=sqrt($nombre);$i++)
            if($nombre%$i==0)
                return false;

        return true;
    }

    echo "<table><tr>";

    for ($i=1;$i<=20;$i++){
        echo estPremier($i)?"<td style='color:red'>$i</td>":"<td>$i</td>";

        if($i%5==0 && $i!=20)
            echo "</tr><tr>";
    }

    echo "</tr></table>"


    ?>


</body>
</html>

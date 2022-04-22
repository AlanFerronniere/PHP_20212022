<?php
namespace Geometrie;

include_once "Point.php";

class Polygone
{
    private $lesPoints;

    public function __construct(...$desPoints)
    {
        $this->lesPoints=$desPoints;
    }

    public function __toString() : String {
        $s="[";
        foreach ($this->lesPoints as $p)
            $s.=$p.",";
        $s.="]";

        return $s;
    }

    public function CalculerPerimetre() : float{
        //A faire pour la semaine prochaine :)
    }
}
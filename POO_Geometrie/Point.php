<?php

namespace Geometrie;

class Point
{
    public int $x;
    public int $y;

    public function __construct(int $abscisse, int $ordonnee)
    {
        $this->x = $abscisse;
        $this->y = $ordonnee;
    }

    public function __toString(): string
    {
        return "(" . $this->x . ";" . $this->y . ")"; //retourne une chaine style (3;4)
    }

    function CalculerDistance(Point $autrePoint): float
    {
        return sqrt(pow($this->x - $autrePoint->x, 2) + pow($this->y - $autrePoint->y, 2));
    }
}
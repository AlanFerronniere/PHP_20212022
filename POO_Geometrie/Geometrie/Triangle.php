<?php

namespace Geometrie;

class Triangle extends Polygone
{
    public function __construct(Point $a, Point $b, Point $c)
    {
        parent::__construct($a, $b, $c);
    }

    public function EstIsocele(): bool
    {
        $c1 = $this->lesPoints[0]->CalculerDistance($this->lesPoints[1]);
        $c2 = $this->lesPoints[2]->CalculerDistance($this->lesPoints[1]);
        $c3 = $this->lesPoints[0]->CalculerDistance($this->lesPoints[2]);

        return $c1 == $c2 || $c1 == $c3 || $c2 == $c3;
    }

    public function CalculerAire(): float
    {
        //https://fr.wikipedia.org/wiki/Formule_de_H%C3%A9ron
        $c1 = $this->lesPoints[0]->CalculerDistance($this->lesPoints[1]);
        $c2 = $this->lesPoints[2]->CalculerDistance($this->lesPoints[1]);
        $c3 = $this->lesPoints[0]->CalculerDistance($this->lesPoints[2]);
        $p = ($c1 + $c2 + $c3) / 2;

        return sqrt($p * ($p - $c1) * ($p - $c2) * ($p - $c3));
    }
}
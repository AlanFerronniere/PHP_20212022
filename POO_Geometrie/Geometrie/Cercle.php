<?php

namespace Geometrie;

class Cercle implements IFigure
{
    public Point $centre;
    public float $rayon;

    public function __construct(Point $o, float $r)
    {
        $this->centre = $o;
        $this->rayon = $r;
    }

    public function CalculerPerimetre(): float
    {
        return 2 * pi() * $this->rayon;
    }

    public function CalculerAire(): float
    {
        return pi() * $this->rayon * $this->rayon;
    }

    public function GenererJS(string $ctx){
        echo "$ctx.beginPath();";
        echo "$ctx.arc(".$this->centre->x.", ".$this->centre->y.", ".$this->rayon.", 0, 2 * Math.PI, false);";
        echo "$ctx.fill();";
    }

    public function __toString()
    {
        return $this->centre."/".$this->rayon;
    }
}
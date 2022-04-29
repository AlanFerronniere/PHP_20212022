<?php

namespace Geometrie;

abstract class Polygone implements IFigure
{
    protected $lesPoints;

    public function __construct(...$desPoints)
    {
        $this->lesPoints = $desPoints;
    }

    public function __toString(): string
    {
        $s = "[";
        foreach ($this->lesPoints as $p)
            $s .= $p . ",";
        $s .= "]";

        return $s;
    }

    public function CalculerPerimetre(): float
    {
        $res = 0;

        for ($i = 0; $i < count($this->lesPoints) - 1; $i++)
            $res += $this->lesPoints[$i]->CalculerDistance($this->lesPoints[$i + 1]);

        $res += $this->lesPoints[0]->CalculerDistance($this->lesPoints[count($this->lesPoints) - 1]);

        return $res;
    }

    public abstract function CalculerAire(): float;

    public function GenererJS(string $ctx)
    {
        echo "$ctx.beginPath();";

        echo "$ctx.moveTo(" . $this->lesPoints[0]->x . "," . $this->lesPoints[0]->y . ");";

        for ($i = 1; $i < count($this->lesPoints); $i++)
            echo "$ctx.lineTo(" . $this->lesPoints[$i]->x . "," . $this->lesPoints[$i]->y . ");";

        echo "$ctx.closePath();";
        echo "$ctx.fill();";

    }
}
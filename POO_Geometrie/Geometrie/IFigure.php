<?php

namespace Geometrie;

interface IFigure
{
    public function CalculerPerimetre() : float;
    public function CalculerAire() : float;
    public function GenererJS(string $ctx);
}
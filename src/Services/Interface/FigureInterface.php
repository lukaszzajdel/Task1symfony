<?php

declare(strict_types=1);

namespace App\Services\Interface;

interface FigureInterface
{
    public function getPerimeter():float;

    public function getSurface():float;
}

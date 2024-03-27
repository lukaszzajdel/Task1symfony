<?php 

declare(strict_types=1);

namespace Tests;

use App\Entity\Square;
use PHPUnit\Framework\TestCase;

class SquareTest extends TestCase

{
    public function test_it_get_surface()
    {
        $square = new Square();

        $square->setSideLenght(1.1);

        $square->setSurface();

        $surface = $square->getSurface();

        $this->assertEquals(1.21,$surface);


    }
    public function test_it_get_perimeter()
    {
        $square = new Square();

        $square->setSideLenght(1.1);

        $square->setPerimeter();

        $perimeter = $square->getPerimeter();

        $this->assertEquals(4.4,$perimeter);


    }

    
}
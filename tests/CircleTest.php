<?php 

declare(strict_types=1);

namespace Tests;

use App\Entity\Circle;
use PHPUnit\Framework\TestCase;

class CircleTest extends TestCase

{
    public function test_it_get_surface()
    {
        $circle = new Circle();

        $circle->setRadius(1.1);

        $circle->setSurface();

        $surface = $circle->getSurface();

        $this->assertEquals(3.8,$surface);


    }
    public function test_it_get_perimeter()
    {
        $circle = new Circle();

        $circle->setRadius(1.1);

        $circle->setPerimeter();

        $perimeter = $circle->getPerimeter();

        $this->assertEquals(6.91,$perimeter);


    }

    
}
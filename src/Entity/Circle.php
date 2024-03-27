<?php

namespace App\Entity;

use App\Services\Interface\FigureInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CircleRepository;

#[ORM\Entity(repositoryClass: CircleRepository::class)]
class Circle implements FigureInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[Assert\GreaterThan(0)]
    private ?float $radius = null;

    #[ORM\Column]
    private ?float $surface = null;

    #[ORM\Column]
    private ?float $perimeter = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRadius(): ?float
    {
        return $this->radius;
    }

    public function setRadius(float $radius): static
    {
        $this->radius = $radius;

        return $this;
    }

    public function getSurface(): float
    {
        return $this->surface;
    }

    public function setSurface(): static
    {
       $this->surface =   round(M_PI * pow($this->radius,2),2);
       return $this;
    }

    public function getPerimeter(): float
    {
        return  $this->perimeter;
    }

    public function setPerimeter(): static
    {
        $this->perimeter = round((2 * M_PI * $this->radius),2) ;
        return $this;
    }
}

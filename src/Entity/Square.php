<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\SquareRepository;
use App\Services\Interface\FigureInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SquareRepository::class)]
class Square implements FigureInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[Assert\GreaterThan(0)]
    private ?float $sideLenght = null;

    #[ORM\Column]
    private ?float $surface = null;

    #[ORM\Column]
    private ?float $perimeter = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSideLenght(): ?float
    {
        return $this->sideLenght;
    }

    public function setSideLenght(float $sideLenght): static
    {
        $this->sideLenght = $sideLenght;

        return $this;
    }

    public function getSurface(): float
    {

        return $this->surface;
    }

    public function setSurface(): static
    {
        $this->surface = round(pow($this->sideLenght, 2), 2);

        return $this;
    }

    public function getPerimeter(): float
    {
        return $this->perimeter;
    }

    public function setPerimeter(): static
    {
        $this->perimeter = round((4 * $this->sideLenght), 2);

        return $this;
    }
}

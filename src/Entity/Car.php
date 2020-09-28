<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CarRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=CarRepository::class)
 */
class Car
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $engine;

    /**
     * @ORM\Column(type="integer")
     */
    private $wheels;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $model;

    /**
     * @ORM\ManyToOne(targetEntity=Dealer::class, inversedBy="cars")
     */
    private $dealer;

    /**
     * @ORM\ManyToOne(targetEntity=CarCategory::class, inversedBy="cars")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEngine(): ?string
    {
        return $this->engine;
    }

    public function setEngine(string $engine): self
    {
        $this->engine = $engine;

        return $this;
    }

    public function getWheels(): ?int
    {
        return $this->wheels;
    }

    public function setWheels(int $wheels): self
    {
        $this->wheels = $wheels;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getDealer(): ?Dealer
    {
        return $this->dealer;
    }

    public function setDealer(?Dealer $dealer): self
    {
        $this->dealer = $dealer;

        return $this;
    }

    public function getCategory(): ?CarCategory
    {
        return $this->category;
    }

    public function setCategory(?CarCategory $category): self
    {
        $this->category = $category;

        return $this;
    }
}

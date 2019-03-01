<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PcRepository")
 */
class Pc
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $code;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Product", inversedBy="pc", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $model;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $speed;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $ram;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $hd;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cd;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $price;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?int
    {
        return $this->code;
    }

    public function setCode(int $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getModel(): ?Product
    {
        return $this->model;
    }

    public function setModel(Product $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getSpeed(): ?int
    {
        return $this->speed;
    }

    public function setSpeed(?int $speed): self
    {
        $this->speed = $speed;

        return $this;
    }

    public function getRam(): ?int
    {
        return $this->ram;
    }

    public function setRam(?int $ram): self
    {
        $this->ram = $ram;

        return $this;
    }

    public function getHd(): ?int
    {
        return $this->hd;
    }

    public function setHd(?int $hd): self
    {
        $this->hd = $hd;

        return $this;
    }

    public function getCd(): ?string
    {
        return $this->cd;
    }

    public function setCd(?string $cd): self
    {
        $this->cd = $cd;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): self
    {
        $this->price = $price;

        return $this;
    }
}

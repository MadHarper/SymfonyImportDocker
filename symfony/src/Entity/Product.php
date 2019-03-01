<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $maker;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $model;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Pc", mappedBy="model", cascade={"persist", "remove"})
     */
    private $pc;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Laptop", mappedBy="model", cascade={"persist", "remove"})
     */
    private $laptop;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Printer", mappedBy="model", cascade={"persist", "remove"})
     */
    private $printer;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getMaker(): ?string
    {
        return $this->maker;
    }

    public function setMaker(string $maker): self
    {
        $this->maker = $maker;

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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Pc[]
     */
    public function getPc(): PersistentCollection
    {
        return $this->pc;
    }

    public function setPc(Pc $pc): self
    {
        $this->pc = $pc;

        // set the owning side of the relation if necessary
        if ($this !== $pc->getModel()) {
            $pc->setModel($this);
        }

        return $this;
    }

    public function getLaptop()
    {
        return $this->laptop;
    }

    public function setLaptop(?Laptop $laptop): self
    {
        $this->laptop = $laptop;

        // set (or unset) the owning side of the relation if necessary
        $newModel = $laptop === null ? null : $this;
        if ($newModel !== $laptop->getModel()) {
            $laptop->setModel($newModel);
        }

        return $this;
    }

    public function getPrinter()
    {
        return $this->printer;
    }

    public function setPrinter(?Printer $printer): self
    {
        $this->printer = $printer;

        // set (or unset) the owning side of the relation if necessary
        $newModel = $printer === null ? null : $this;
        if ($newModel !== $printer->getModel()) {
            $printer->setModel($newModel);
        }

        return $this;
    }
}

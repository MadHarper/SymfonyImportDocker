<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PeopleRepository")
 */
class People
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
     * @ORM\OneToMany(targetEntity="Bug", mappedBy="engineer")
     */
    protected $reportedBugs;

    /**
     * @ORM\OneToMany(targetEntity="Bug", mappedBy="engineer")
     */
    protected $assignedBugs;

    public function __construct()
    {
        $this->reportedBugs = new ArrayCollection();
        $this->assignedBugs = new ArrayCollection();
    }

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

    public function addReportedBug(Bug $bug): self
    {
        $this->reportedBugs[] = $bug;
        return $this;
    }

    public function assignedToBug(Bug $bug): self
    {
        $this->assignedBugs[] = $bug;
        return $this;
    }
}

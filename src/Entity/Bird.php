<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BirdRepository")
 */
class Bird
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(name="id", type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $scientific_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $vern_name;

    public function getId()
    {
        return $this->id;
    }

    public function getScientificName(): ?string
    {
        return $this->scientific_name;
    }

    public function setScientificName(?string $scientific_name): self
    {
        $this->scientific_name = $scientific_name;

        return $this;
    }

    public function getVernName(): ?string
    {
        return $this->vern_name;
    }

    public function setVernName(string $vern_name): self
    {
        $this->vern_name = $vern_name;

        return $this;
    }

    public function __toString() {
        return $this->vern_name;
        return $this->scientific_name;
    }
}

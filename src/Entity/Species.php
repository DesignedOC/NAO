<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SpeciesRepository")
 */
class Species
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $ordre;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $famille;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     */
    private $cdNom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $lbNom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $nomVern;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     */
    private $habitat;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $statut;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $url;

    public function getId()
    {
        return $this->id;
    }

    public function getOrdre(): ?string
    {
        return $this->ordre;
    }

    public function setOrdre(string $ordre): self
    {
        $this->ordre = $ordre;

        return $this;
    }

    public function getFamille(): ?string
    {
        return $this->famille;
    }

    public function setFamille(string $famille): self
    {
        $this->famille = $famille;

        return $this;
    }

    public function getCdNom(): ?int
    {
        return $this->cdNom;
    }

    public function setCdNom(int $cdNom): self
    {
        $this->cdNom = $cdNom;

        return $this;
    }

    public function getLbNom(): ?string
    {
        return $this->lbNom;
    }

    public function setLbNom(string $lbNom): self
    {
        $this->lbNom = $lbNom;

        return $this;
    }

    public function getNomVern(): ?string
    {
        return $this->nomVern;
    }

    public function setNomVern(string $nomVern): self
    {
        $this->nomVern = $nomVern;

        return $this;
    }

    public function getHabitat(): ?int
    {
        return $this->habitat;
    }

    public function setHabitat(int $habitat): self
    {
        $this->habitat = $habitat;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }
}

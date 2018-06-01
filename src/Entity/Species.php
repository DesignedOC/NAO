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


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return null|string
     */

    public function getOrdre(): ?string

    {
        return $this->ordre;
    }


    /**
     * @param string $ordre
     * @return Species
     */

    public function setOrdre(string $ordre): self
    {
        $this->ordre = $ordre;

        return $this;
    }

    public function getFamille(): ?string

    {
        return $this->famille;
    }


    /**
     * @param string $famille
     * @return Species
     */

    public function setFamille(string $famille): self

    {
        $this->famille = $famille;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getCdNom(): ?int
    {
        return $this->cdNom;
    }

    /**
     * @param int $cdNom
     * @return Species
     */
    public function setCdNom(int $cdNom): self
    {
        $this->cdNom = $cdNom;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getLbNom(): ?string
    {
        return $this->lbNom;
    }

    /**
     * @param string $lbNom
     * @return Species
     */
    public function setLbNom(string $lbNom): self
    {
        $this->lbNom = $lbNom;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getNomVern(): ?string
    {
        return $this->nomVern;
    }

    /**
     * @param string $nomVern
     * @return Species
     */
    public function setNomVern(string $nomVern): self
    {
        $this->nomVern = $nomVern;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getHabitat(): ?int
    {
        return $this->habitat;
    }

    /**
     * @param int $habitat
     * @return Species
     */
    public function setHabitat(int $habitat): self
    {
        $this->habitat = $habitat;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getStatut(): ?string
    {
        return $this->statut;
    }

    /**
     * @param string $statut
     * @return Species
     */
    public function setStatut(string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return Species
     */
    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }
}

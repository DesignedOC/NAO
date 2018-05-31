<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ObservationsRepository")
 * @Vich\Uploadable
 */
class Observations
{
    const STATUS_UNTREATED = 'untreated';
    const STATUS_ACCEPTED = 'accepted';
    const STATUS_REJECTED = 'rejected';
    const STATUS_DRAFT = 'draft';
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank()
     */
    private $date;

    /**
     * @ORM\Column(type="float", nullable=false)
     * @Assert\NotBlank(message = "La lattitude est obligatoire")
     */
    private $latitude;

    /**
     * @ORM\Column(type="float", nullable=false)
     * @Assert\NotBlank(message = "La longitude est obligatoire")
     */
    private $longitude;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     * @Assert\Valid
     */
    private $picture;

    /**
     * @ORM\Column(type="string", length=1)
     * @ORM\ManyToOne(targetEntity="App\Entity\Species", cascade={"persist"})
     * @Assert\NotBlank()
     */
    private $bird;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", cascade={"persist"})
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=64, nullable=false, columnDefinition="ENUM('untreated', 'accepted', 'rejected', 'draft')", options={"default":"untreated"})
     * @Assert\NotBlank()
     */
    private $statut;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     */
    private $description;

    /**
     * @Vich\UploadableField(mapping="product_images", fileNameProperty="picture")
     * @var File
     */
    private $pictureFile;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    public function __construct()
    {
        $this->date = new \Datetime();
        $this->updatedAt = new \DateTime();
    }


    public function getId()
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): void
    {
        $this->picture = $picture;

    }

    public function getBird(): ?string
    {
        return $this->bird;
    }

    public function setBird(string $bird): self
    {
        $this->bird = $bird;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPictureFile(): ?File
    {
        return $this->pictureFile;
    }

    public function setPictureFile(?File $picture = null):void
    {
        $this->pictureFile = $picture;
        if(null != $picture)
        {
            $this->updatedAt = new \DateTime();
        }

    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}

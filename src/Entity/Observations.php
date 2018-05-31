<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @ORM\Table(name="nao_observ")
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
     * @Vich\UploadableField(mapping="product_images", fileNameProperty="picture")
     * @var File
     */
    private $pictureFile;
    /**
     * @ORM\Column(type="string", length=1)
     * @ORM\ManyToOne(targetEntity="App\Entity\Species", cascade={"persist"})
     * @Assert\NotBlank()
     */
    private $bird;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="observations")
     * @ORM\JoinColumn(nullable=false)
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

    public function __construct()
    {
        $this->date = new \Datetime();
    }
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @return \DateTimeInterface|null
     */
    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }
    /**
     * @param \DateTimeInterface $date
     * @return Observations
     */
    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;
        return $this;
    }
    public function getLatitude(): ?float
    {
        return $this->latitude;
    }
    /**
     * @param float $latitude
     * @return Observations
     */
    public function setLatitude(float $latitude): self
    {
        $this->latitude = $latitude;
        return $this;
    }
    /**
     * @return float|null
     */
    public function getLongitude(): ?float
    {
        return $this->longitude;
    }
    /**
     * @param float $longitude
     * @return Observations
     */
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
    /**
     * @return null|string
     */
    public function getBird(): ?string
    {
        return $this->bird;
    }
    /**
     * @param string $bird
     * @return Observations
     */
    public function setBird(string $bird): self
    {
        $this->bird = $bird;
        return $this;
    }
    /**
     * @param User $user
     */
    public function setUser(User $user)
    {
        $this->user = $user;
    }
    /**
     * @return user
     */
    public function getUser()
    {
        return $this->user;
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
     * @return Observations
     */
    public function setStatut(string $statut): self
    {
        $this->statut = $statut;
        return $this;
    }
    /**
     * @return null|string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }
    /**
     * @param string $description
     * @return Observations
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }
}
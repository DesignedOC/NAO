<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
/**
 * @ORM\Table(name="nao_observ")
 * @ORM\Entity(repositoryClass="App\Repository\ObservationRepository")
 * @Vich\Uploadable
 */
class Observation
{
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
     * @Assert\File(
     *     maxSize="2M",
     *     mimeTypes={"image/png", "image/jpeg", "image/pjpeg"}
     * )
     * @Vich\UploadableField(mapping="observations_images", fileNameProperty="picture")
     * @var File
     */
    private $pictureFile;

    /**
     * @ORM\JoinColumn(name="bird", referencedColumnName="id")
     * @ORM\ManyToOne(targetEntity="App\Entity\Bird", cascade={"persist"})
     * @Assert\Type(type="App\Entity\Bird")
     * @Assert\Valid()
     */
    private $bird;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="observations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * 0 = rejected, 1 = under validation, 2 = validated
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *      min = 0,
     *      max = 2
     * )
     */
    private $statut;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    public function __construct()
    {
        $this->date = new \Datetime();
        $this->statut = 1;
        $this->updatedAt = new \DateTime();
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
     * @return Observation
     */
    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    /**
     * @param float $latitude
     * @return Observation
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
     * @return Observation
     */
    public function setLongitude(float $longitude): self
    {
        $this->longitude = $longitude;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getPicture(): ?string
    {
        return $this->picture;
    }

    /**
     * @param null|string $picture
     */
    public function setPicture(?string $picture): void
    {
        $this->picture = $picture;
    }

    /**
     * @return null|File
     */
    public function getPictureFile(): ?File
    {
        return $this->pictureFile;
    }

    /**
     * @param null|File $picture
     */
    public function setPictureFile(?File $picture = null):void
    {
        $this->pictureFile = $picture;
        if (null != $picture) {
            $this->updatedAt = new \DateTime();
        }
    }

    /**
     * @return Bird
     */
    public function getBird()
    {
        return $this->bird;
    }
    /**
     * @param Bird $bird
     * @return Observation
     */
    public function setBird(Bird $bird = null)
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
     * @return Observation
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
     * @return Observation
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param $updatedAt
     * @return $this
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
    
    public function getLibelleStatut()
    {
        switch ($this->statut) {
            case 0:
                return 'rejeté';
                break;
            case 1:
                return 'en attente de validation';
                break;
            case 2;
                return 'validé';
                break;
        }
    }

}
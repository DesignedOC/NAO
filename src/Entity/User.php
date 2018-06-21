<?php

namespace App\Entity;

use DateTime;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="nao_user")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @Vich\Uploadable
 */
class User extends BaseUser
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @var string $lastname
     * @ORM\Column(name="usr_lastname", type="string", length=100, nullable=true)
     */

    private $lastname;
    /**
     * @var string $firstname
     * @ORM\Column(name="usr_firstname", type="string", length=100, nullable=true)
     */
    private $firstname;

    /**
     * @var DateTime $birth
     * @ORM\Column(name="usr_birth", type="datetime", nullable=true)
     */
    private $birth;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string
     */
    private $image;

    /**
     * @Assert\File(
     *     maxSize="2M",
     *     mimeTypes={"image/png", "image/jpeg", "image/pjpeg"}
     * )
     * @Vich\UploadableField(mapping="avatar_images", fileNameProperty="image")
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="datetime")
     * @var DateTime
     */
    private $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Observation", mappedBy="user")
     */
    private $observations;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Badge", mappedBy="user")
     */
    private $badges;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Application", mappedBy="user")
     */
    private $applications;

    /**
     * User constructor.
     */

    public function __construct()
    {
        parent::__construct();
        $this->observations = new ArrayCollection();
        $this->badges = new ArrayCollection();
        $this->updatedAt = new DateTime();
    }
    /**
     * @return null|string
     */
    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     * @return User
     */
    public function setLastname(?string $lastname): self
    {
        $this->lastname = $lastname;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     * @return User
     */
    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;
        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getBirth(): ?\DateTimeInterface
    {
        return $this->birth;
    }

    /**
     * @param DateTime $birth
     * @return User
     */
    public function setBirth(DateTime $birth): self
    {
        $this->birth = $birth;
        return $this;
    }

    /**
     * @param File|null $image
     */
    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        if ($image) {
            $this->updatedAt = new DateTime('now');
        }
    }

    /**
     * @return File
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * @param $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @return Collection|Observation[]
     */
    public function getObservation() : Collection
    {
        return $this->observations;
    }

    /**
     * @param Observation $observation
     */
    public function addObservation(Observation $observation)
    {
        $this->observations[] = $observation;
        $observation->setUser($this);
    }

    /**
     * @param Observation $observation
     */
    public function removeObservation(Observation $observation)
    {
        $this->observations->removeElement($observation);
    }

    /**
     * @return Collection|Badge[]
     */
    public function getBadges(): Collection
    {
        return $this->badges;
    }

    /**
     * @param Badge $badge
     * @return User
     */
    public function addBadge(Badge $badge): self
    {
        $this->badges[] = $badge;
        $badge->setUser($this);
    }

    /**
     * @param Badge $badge
     * @return User
     */
    public function removeBadge(Badge $badge): self
    {
        $this->badges->removeElement($badge);
    }

    /**
     * @return Collection|Application[]
     */
    public function getApplications(): Collection
    {
        return $this->applications;
    }

    /**
     * @param Application $application
     * @return User
     */
    public function addApplications(Application $application): self
    {
        $this->applications[] = $application;
        $application->setUser($this);
    }

    /**
     * @param Application $application
     * @return User
     */
    public function removeApplication(Application $application): self
    {
        $this->applications->removeElement($application);
    }


}
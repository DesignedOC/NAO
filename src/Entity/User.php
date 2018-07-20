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
     * @var DateTime $dateFrom
     * @ORM\Column(name="usr_datefrom", type="datetime", nullable=true)
     */
    private $dateFrom;

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
     * Get Email every time your observation is acccepted
     * @ORM\Column(name="usr_obsemail", type="boolean", nullable=true)
     * @var Boolean
     */
    private $obsEmail;

    /**
     * Allow the association to use your data for search program
     * @ORM\Column(name="usr_datashare", type="boolean", nullable=true)
     * @var Boolean
     */
    private $dataShare;

    /**
     * Subscribe on newsletter by member statut
     * @ORM\Column(name="usr_newsletter", type="boolean", nullable=true)
     * @var Boolean
     */
    private $newsletter;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Observation", mappedBy="user", cascade = {"remove"})
     */
    private $observations;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Player", mappedBy="user")
     */
    private $players;

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
        $this->updatedAt = new DateTime();
        $this->dateFrom = new DateTime();
        $this->setObsEmail(0);
        $this->setDataShare(0);
        $this->setNewsletter(0);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
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
    public function getBirth(): ?\DateTime
    {
        return $this->birth;
    }

    /**
     * @param DateTime $birth
     * @return User
     */
    public function setBirth(?DateTime $birth): self
    {
        $this->birth = $birth;
        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getDateFrom(): ?\DateTime
    {
        return $this->dateFrom;
    }

    /**
     * @return int|null
     */
    public function getMonthsFromDate(): ?Int
    {
//        $date = new DateTime('2017-06-22');  Date Test 12 months
        $date = new DateTime('NOW');
        $monthsYear = $this->getDateFrom()->diff($date)->y*12;
        $months = $this->getDateFrom()->diff($date)->m;

        $total = $monthsYear + $months;
        return $total;
    }

    /**
     * @param DateTime $dateFrom
     * @return User
     */
    public function setDateFrom(?DateTime $dateFrom): self
    {
        $this->dateFrom = $dateFrom;
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
     * @return Collection|Player[]
     */
    public function getPlayer() : Collection
    {
        return $this->players;
    }

    /**
     * @param Player $player
     */
    public function addPlayer(Player $player)
    {
        $this->players[] = $player;
        $player->setUser($this);
    }

    /**
     * @param Player $player
     */
    public function removePlayer(Player $player)
    {
        $this->players->removeElement($player);
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

    /**
     * @return bool
     */
    public function isObsEmail(): bool
    {
        return $this->obsEmail;
    }

    /**
     * @param bool $obsEmail
     */
    public function setObsEmail(bool $obsEmail): void
    {
        $this->obsEmail = $obsEmail;
    }

    /**
     * @return bool
     */
    public function isDataShare(): bool
    {
        return $this->dataShare;
    }

    /**
     * @param bool $dataShare
     */
    public function setDataShare(bool $dataShare): void
    {
        $this->dataShare = $dataShare;
    }

    /**
     * @return bool
     */
    public function isNewsletter(): bool
    {
        return $this->newsletter;
    }

    /**
     * @param bool $newsletter
     */
    public function setNewsletter(bool $newsletter): void
    {
        $this->newsletter = $newsletter;
    }
}
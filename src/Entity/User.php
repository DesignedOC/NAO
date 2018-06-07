<?php

namespace App\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
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
     * @ORM\Column(name="lastname", type="string", length=100, nullable=true)
     */

    private $lastname;
    /**
     * @var string $firstname
     * @ORM\Column(name="firstname", type="string", length=100, nullable=true)
     */
    private $firstname;

    /**
     * @var \DateTime $birth
     * @ORM\Column(name="birth", type="datetime", nullable=true)
     */
    private $birth;

    /**
     * @ORM\OneToMany(targetEntity="Observation", mappedBy="user")
     */
    private $observations;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Badge", mappedBy="user")
     */
    private $badges;

    /**
     * User constructor.
     */

    public function __construct()
    {
        parent::__construct();
        $this->observations = new ArrayCollection();
        $this->badges = new ArrayCollection();
        $this->birth = new \DateTime();
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
    public function setLastname(string $lastname): self
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
     * @return \DateTimeInterface|null
     */
    public function getBirth(): ?\DateTimeInterface
    {
        return $this->birth;
    }

    /**
     * @param \DateTimeInterface $birth
     * @return User
     */
    public function setBirth(\DateTimeInterface $birth): self
    {
        $this->birth = $birth;
        return $this;
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


}
<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="nao_tournament")
 * @ORM\Entity(repositoryClass="App\Repository\TournamentRepository")
 */
class Tournament
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="Vous devez saisir un titre pour ce tournoi")
     */
    private $title;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank()
     */
    private $startDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $endDate;

    /**
     * @ORM\Column(type="text")
     */
    private $rules;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Vous devez saisir une note concernant la date de fin du tournoi")
     */
    private $endNote;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Player", mappedBy="tournament")
     */
    private $players;

    /**
     * @ORM\Column(type="integer")
     */
    private $active;

    /**
     * Tournament constructor.
     */
    public function __construct()
    {
        $this->startDate = new DateTime();
        $this->endDate = new DateTime();
        $this->setActive(1);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @param mixed $startDate
     */
    public function setStartDate($startDate): void
    {
        $this->startDate = $startDate;
    }

    /**
     * @return mixed
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @param mixed $endDate
     */
    public function setEndDate($endDate): void
    {
        $this->endDate = $endDate;
    }

    /**
     * @return mixed
     */
    public function getRules()
    {
        return $this->rules;
    }

    /**
     * @param mixed $rules
     */
    public function setRules($rules): void
    {
        $this->rules = $rules;
    }

    /**
     * @return mixed
     */
    public function getEndNote()
    {
        return $this->endNote;
    }

    /**
     * @param mixed $endNote
     */
    public function setEndNote($endNote): void
    {
        $this->endNote = $endNote;
    }

    /**
     * @return Player
     */
    public function getPlayers()
    {
        return $this->players;
    }

    /**
     * @param Player $player
     */
    public function addPlayer(Player $player)
    {
        $this->players[] = $player;
        $player->setTournament($this);
    }

    /**
     * @param Player $player
     */
    public function removePlayer(Player $player)
    {
        $this->players->removeElement($player);
    }

    /**
     * @return mixed
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @param mixed $active
     */
    public function setActive($active): void
    {
        $this->active = $active;
    }
}
<?php
namespace App\Services;

use App\Entity\Observation;
use App\Entity\Player;
use App\Entity\Tournament;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class TournamentManager {

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * BadgeManager constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param User $user
     */
    public function addPointsToTournament(User $user)
    {
        $lastTn = $this->em->getRepository(Tournament::class)->findLastTournament();
        /** @var Player $player
         * @var User $user
         */
        $player = $this->em->getRepository(Player::class)->findOneByUser($lastTn, $user);

        if($player)
        {
            $player->addPoints();
            $this->em->persist($player);
        }

        if(!$player AND $lastTn != null AND $lastTn->getActive() == 1)
        {
            $player = new Player();
            $player->setTournament($lastTn);
            $player->setUser($user);
            $player->addPoints();
            $this->em->persist($player);
        }

    }




}
<?php

namespace App\EventSubscriber;

use App\Entity\Player;
use App\Entity\Tournament;
use App\Services\MailerManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

class TournamentSubscriber implements EventSubscriberInterface
{

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var MailerManager
     */
    private $mailer;

    /**
     * TournamentSubscriber constructor.
     * @param EntityManagerInterface $entityManager
     * @param MailerManager $mailerManager
     */
    public function __construct(EntityManagerInterface $entityManager, MailerManager $mailerManager)
    {
        $this->em = $entityManager;
        $this->mailer = $mailerManager;
    }

    /**
     * @param GenericEvent $event
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function onEasyAdminPostPersist(GenericEvent $event)
    {
        $entity = $event->getSubject();

        if (!($entity instanceof Tournament)) {
            return;
        }

        /* @var Tournament $tournament */
        $tournament = $this->em->getRepository(Tournament::class)->findSecondLastTournament();

        $firstWinner = $this->em->getRepository(Player::class)->findTopOneOfTn($tournament);
        $secondWinner = $this->em->getRepository(Player::class)->findTopSecondOfTn($tournament);
        $thirdWinner = $this->em->getRepository(Player::class)->findTopThirdOfTn($tournament);

        if($tournament AND $tournament->getActive() == 1)
        {
            $tournament->setEndDate(new \DateTime('NOW'));
            $tournament->setActive(0);
            if($tournament->getPlayers())
            {
                if($firstWinner)
                {
                    $this->mailer->sendFirstWinnerOfTn($firstWinner, $tournament);
                }
                if($secondWinner)
                {
                    $this->mailer->sendSecondWinnerOfTn($secondWinner, $tournament);
                }
                if($thirdWinner)
                {
                    $this->mailer->sendThirdWinnerOfTn($thirdWinner, $tournament);
                }
            }
            $this->em->persist($tournament);
            $this->em->flush();
        }
    }

    public static function getSubscribedEvents()
    {
        return [
           'easy_admin.post_persist' => 'onEasyAdminPostPersist',
        ];
    }
}

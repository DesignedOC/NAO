<?php
namespace App\Services;

use App\Entity\Application;
use App\Entity\Bird;
use App\Entity\Observation;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class MainManager {

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
     * Get current Application by Statut
     * @param User $user
     * @return Application|null
     */
    public function getApplicationByStatut(User $user)
    {
        $id = $user->getId();
        /** @var Application $application */
        $application = $this->em->getRepository(Application::class)->findOneBy(['user' => $id]);

        return $application;
    }

    /**
     * Get the number of applications
     * @return Observation|null
     */
    public function getAllCountObservations()
    {
        /** @var Observation $nbObservations */
        $nbObservations = $this->em->getRepository(Observation::class)->findAllObservationsCount();

        return $nbObservations;
    }

    /**
     * Get the number of applications
     * @return Observation|null
     */
    public function getAllCountBirds()
    {
        /** @var Bird $bird */
        $nbBirds = $this->em->getRepository(Bird::class)->findAllBirdsCount();

        return $nbBirds;
    }
}
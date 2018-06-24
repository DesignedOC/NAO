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
     * Get the number of observations
     * @return int|null
     */
    public function getAllCountObservations()
    {
        /** @var Int $nbObservations */
        $nbObservations = $this->em->getRepository(Observation::class)->findAllObservationsCount();

        return $nbObservations;
    }

    /**
     * Get the number of birds
     * @return Int|null
     */
    public function getAllCountBirds()
    {
        /** @var Int $bird */
        $nbBirds = $this->em->getRepository(Bird::class)->countNb();

        return $nbBirds;
    }

    /**
     * Get the number of applications
     * @return Application|null
     */
    public function getAllCountApplications()
    {
        /** @var Bird $bird */
        $nbApplication = $this->em->getRepository(Application::class)->findAllApplicationCount();

        return $nbApplication;
    }
}
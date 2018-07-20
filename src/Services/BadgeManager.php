<?php
namespace App\Services;

use App\Entity\Observation;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class BadgeManager {

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
     * @return array|null
     */
    public function getBadgesOfUser(User $user)
    {
        $observations = $this->getCountOfValidObserv($user);
        $months = $user->getMonthsFromDate();

        $badges = [];

        foreach($this->getBadgesList() as $key => $val)
        {
                if($val['observations'] <= $observations && $val['months'] == 0) {
                        array_push($badges, $key);
                }

                if($val['observations'] == 0 && $val['months'] <= $months) {
                        array_push($badges, $key);
                }
        }

        if($user->getImage())
        {
            array_push($badges, "Timide");
        }

        return $badges;

    }

    /**
     * List of badges with conditions and images
     * @return array
     */
    private function getBadgesList()
    {
        return [
            'Apprenti' => ['observations' => 1, 'months' => null],
            'Dynamique' => ['observations' => 10, 'months' => null],
            'Certifié' => ['observations' => 50, 'months' => null],
            'Respectable' => ['observations' => 100, 'months' => null],
            'Padawan' => ['observations' => null, 'months' => 1],
            'Disciple' => ['observations' => null, 'months' => 6],
            'Acharné' => ['observations' => null, 'months' => 12],
            'Champion' => ['observations' => null, 'months' => 24],
        ];
    }

    /**
     * @param User $user
     * @return mixed
     */
    private function getCountOfValidObserv(User $user)
    {
        $nb = $this->em->getRepository(Observation::class)->getCountOfObserv($user->getId());

        return intval($nb);
    }


}
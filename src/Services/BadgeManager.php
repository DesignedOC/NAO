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
            array_push($badges, "Homme de l'ombre");
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
            'Découverte' => ['observations' => 1, 'months' => null],
            'Passionné' => ['observations' => 10, 'months' => null],
            'Fidèle' => ['observations' => 50, 'months' => null],
            'Expert' => ['observations' => 100, 'months' => null],
            'Rookie' => ['observations' => null, 'months' => 1],
            'Spécialiste' => ['observations' => null, 'months' => 6],
            'Top fidélité' => ['observations' => null, 'months' => 12],
            'Grand fidèle' => ['observations' => null, 'months' => 24],
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
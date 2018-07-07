<?php

namespace App\Repository;

use App\Entity\Player;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Player|null find($id, $lockMode = null, $lockVersion = null)
 * @method Player|null findOneBy(array $criteria, array $orderBy = null)
 * @method Player[]    findAll()
 * @method Player[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlayerRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Player::class);
    }

    /**
     * Find one player by tournament and user
     * @param $tournament
     * @param $user
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneByUser($tournament, $user)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.tournament = :tournament')
            ->andWhere('u.user = :user')
            ->setParameter('tournament', $tournament)
            ->setParameter('user', $user)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    /**
     * Find the TOP winner of a tournament
     * @param $tournament
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findTopOneOfTn($tournament)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.tournament = :tournament')
            ->setParameter('tournament', $tournament)
            ->orderBy('u.points', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    /**
     * Find the second winner of a tournament
     * @param $tournament
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findTopSecondOfTn($tournament)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.tournament = :tournament')
            ->setParameter('tournament', $tournament)
            ->orderBy('u.points', 'DESC')
            ->setFirstResult(1)
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    /**
     * Find the third winner of a tournament
     * @param $tournament
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findTopThirdOfTn($tournament)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.tournament = :tournament')
            ->setParameter('tournament', $tournament)
            ->orderBy('u.points', 'DESC')
            ->setFirstResult(2)
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    /**
     * Find the top ten of the tournament
     * @param $tournament
     * @return mixed
     */
    public function findTopTenByTournament($tournament)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.tournament = :tournament')
            ->setParameter('tournament', $tournament)
            ->orderBy('u.points', 'DESC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
            ;
    }
}

<?php

namespace App\Repository;

use App\Entity\Application;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Application|null find($id, $lockMode = null, $lockVersion = null)
 * @method Application|null findOneBy(array $criteria, array $orderBy = null)
 * @method Application[]    findAll()
 * @method Application[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ApplicationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Application::class);
    }

//    /**
//     * @return Application[] Returns an array of Application objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /**
     * @param $userId
     * @param $statut
     * @return Application|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneByStatut($userId, $statut): ?Application
    {
        return $this->createQueryBuilder('u')
            ->select('u')
            ->where('u.user = :userId')
            ->andWhere('u.statut = :statut')
            ->setParameter('userId', $userId)
            ->setParameter('statut', $statut)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

}

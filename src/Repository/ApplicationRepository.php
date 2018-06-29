<?php

namespace App\Repository;

use App\Entity\Application;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use http\Exception\InvalidArgumentException;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

    /**
     * Get the number of all Applications
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findAppByCount()
    {
        $qb = $this->createQueryBuilder('u')
            ->select('COUNT(u)')
        ;

        return $qb->getQuery()->getSingleScalarResult();
    }

    /**
     * Get the number of all Applications
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findAppCountByStatut()
    {
        $qb = $this->createQueryBuilder('u')
            ->select('COUNT(u)')
            ->where('u.statut = 1')
        ;

        return $qb->getQuery()->getSingleScalarResult();
    }

    /**
     * Get all applications by statut and date
     * @param $page
     * @return mixed
     */
    public function findToPublishByStatut($page)
    {

        if (!is_numeric($page)) {
            throw new InvalidArgumentException("La page que vous souhaitez atteindre ne semble pas valide");
        }

        if($page < 1)
        {
            throw new NotFoundHttpException("Désolé la page souhaitée n'existe pas");
        }

        $qb = $this->createQueryBuilder('u')
            ->select('u')
            ->where('u.statut = 1')
            ->orderBy('u.date', 'DESC')
            ->setMaxResults(10)
            ->setFirstResult($page * 10 - 10);

        return $qb->getQuery()->getResult();
    }

}

<?php
namespace App\Repository;

use App\Entity\Bird;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
/**
 * @method Bird|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bird|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bird[]    findAll()
 * @method Bird[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BirdRepository extends  ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Bird::class);
    }

    /**
     * @return int|mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function countNb()
    {
        $nb = $this
            ->createQueryBuilder('b')
            ->select('count(b) as nb')
            ->getQuery()
            ->getSingleScalarResult();
       return $nb;
    }

//    /**
//     * @return Bird[] Returns an array of Bird objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /**
     * Get the number of Birds
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findAllBirdsCount()
    {
        $qb = $this->createQueryBuilder('u')
            ->select('COUNT(u)')
        ;

        return $qb->getQuery()->getSingleScalarResult();
    }


    /**
     * @param $term
     * @return mixed
     */
    public function findBirdByLbNom($term)
    {
        $qb = $this->createQueryBuilder('b');
        $qb->where($qb->expr()->like('b.lbNom', ':lbnom'))
            ->setParameter("lbnom", "%$term%")
            ->setMaxResults(20);

        return $qb->getQuery()->getResult();
    }

    /**
     * @param $term
     * @return mixed
     */
    public function findBirdByNomVern($term)
    {
        $qb = $this->createQueryBuilder('b');
        $qb->where($qb->expr()->like('b.nomVern', ':nomVern'))
            ->setParameter("nomVern", "%$term%")
            ->setMaxResults(20);

        return $qb->getQuery()->getResult();
    }
}
<?php

namespace App\Repository;

use App\Entity\Observation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Observation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Observation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Observation[]    findAll()
 * @method Observation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */


class ObservationRepository extends ServiceEntityRepository
{
//Méthode de base
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Observation::class);
    }
	
	 /**
     * @return User[] Returns an array of User objects
     */
    
    public function findBylatitude($value)
    {
        return $this->createQueryBuilder('u')
		     ->leftJoin('u.bird', 'u_bird')
            ->andWhere('u_bird.vern_name = :val')
            ->setParameter('val', $value)            
            ->getQuery()
            ->getResult()
        ;
    }
    

}

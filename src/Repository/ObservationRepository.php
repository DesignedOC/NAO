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

//Requete pour avoir l'objet observation grâce à son nom
    public function findObservationBy($str){
        $qb = $this->createQueryBuilder('e');
        $qb->select('e.vern_name as value')
            ->where('e.vern_name LIKE :str')
            ->setParameter('str', '%'.$str.'%');
        return $qb ->getQuery()->getArrayResult();
    }

//Requete pour avoir la LATTITUDE et la LONGITUDE de cet objet
    public function findPlace($dataObservation){
        $qb= $this->createQueryBuilder('e');



        return $qb ->getQuery()->getResult();
    }

}

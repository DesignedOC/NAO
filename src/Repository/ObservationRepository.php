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
    public function findBirdWithObservation($birdNomVern)
    {
        $qb = $this->createQueryBuilder('o')
            ->select('o.id, o.date, o.latitude, o.longitude, o.picture, o.description, b.nomVern, b.lbNom, u.username')
            ->leftJoin('o.bird', 'b')
            ->leftJoin('o.user', 'u');
        $qb->where($qb->expr()->like('b.nomVern', ':nomVern '))
            ->setParameter("nomVern", $birdNomVern);
        return $qb->getQuery()->getScalarResult();
    }
}
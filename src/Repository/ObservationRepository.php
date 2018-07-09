<?php
namespace App\Repository;
use App\Entity\Observation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use http\Exception\InvalidArgumentException;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

    /**
     * Get the total number of waiting approval Observations [validations]
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findObservCountByStatut()
    {
        $qb = $this->createQueryBuilder('u')
            ->select('COUNT(u)')
            ->where('u.statut = 1')
        ;

        return $qb->getQuery()->getSingleScalarResult();
    }

    /**
     * Get the number of Observation from User with statut unpublished
     * @param $userId
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getCountOfObserv($userId)
    {
        $qb = $this->createQueryBuilder('u')
            ->select('COUNT(u)')
            ->where('u.user = :userId')
            ->andWhere('u.statut = 2')
            ->setParameter('userId', $userId)
            ;

        return $qb->getQuery()->getSingleScalarResult();
    }

    /**
     * Count all observations of User | Published or not
     * @param $userId
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getCountOfAllByUser($userId)
    {
        $qb = $this->createQueryBuilder('u')
            ->select('COUNT(u)')
            ->where('u.user = :userId')
            ->setParameter('userId', $userId)
        ;

        return $qb->getQuery()->getSingleScalarResult();
    }

    /**
     * Get the number of observations
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findAllObservationsCount()
    {
        $qb = $this->createQueryBuilder('u')
            ->select('COUNT(u)')
        ;

        return $qb->getQuery()->getSingleScalarResult();
    }

    /**
     * Count all validate observations by statut
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findAllObservationsCountByStatut()
    {
        $qb = $this->createQueryBuilder('u')
            ->select('COUNT(u)')
            ->where('u.statut = 2')
        ;

        return $qb->getQuery()->getSingleScalarResult();
    }

    /**
     * Get all validate observations by statut and date
     * @param $page
     * @return mixed
     */
    public function findObservationsPublished($page)
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
            ->where('u.statut = 2')
            ->orderBy('u.date', 'DESC')
            ->setMaxResults(10)
            ->setFirstResult($page * 10 - 10);

        return $qb->getQuery()->getResult();
    }

    /**
     * Get all observations for User | Mes observations
     * @param $page
     * @param $userId
     * @return mixed
     */
    public function findAllObsByUser($page, $userId)
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
            ->orderBy('u.date', 'DESC')
            ->where('u.user = :userId')
            ->setParameter('userId', $userId)
            ->setMaxResults(10)
            ->setFirstResult($page * 10 - 10);

        return $qb->getQuery()->getResult();
    }

    /**
     * Get all waiting approval observation by statut and ordered by date
     * @param $page
     * @return mixed
     */
    public function findObservByStatut($page)
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

    /**
     * @param $birdNomVern
     * @return array
     */
    public function findBirdWithObservation($birdNomVern)
    {
        $qb = $this->createQueryBuilder('o')
            ->select('o.id, o.date, o.latitude, o.longitude, o.picture, o.description, b.nomVern, b.lbNom, u.username')
            ->leftJoin('o.bird', 'b')
            ->leftJoin('o.user', 'u');
        $qb->where($qb->expr()->like('b.nomVern', ':nomVern '))
            ->andWhere('o.statut = 2')
            ->setParameter("nomVern", $birdNomVern);
        return $qb->getQuery()->getScalarResult();
    }

}
<?php

namespace App\Repository;

use App\Entity\VisitorCounter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<VisitorCounter>
 *
 * @method VisitorCounter|null find($id, $lockMode = null, $lockVersion = null)
 * @method VisitorCounter|null findOneBy(array $criteria, array $orderBy = null)
 * @method VisitorCounter[]    findAll()
 * @method VisitorCounter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VisitorCounterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VisitorCounter::class);
    }

    public function add(VisitorCounter $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(VisitorCounter $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function serachip($userip){
        $qb=$this->createQueryBuilder('p');
        return $qb->select('ipaddress')->where('ipaddress=:key')->setParameter('key',$userip)->getQuery()->getResult();
    }

    public function visitorCount(){
        $qb=$this->createQueryBuilder('p');
        $qb->select('COUNT(p.id)');
        return $qb->getQuery()->getResult();
    }



//    /**
//     * @return VisitorCounter[] Returns an array of VisitorCounter objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('v.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?VisitorCounter
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

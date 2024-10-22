<?php

namespace App\Repository;

use App\Entity\Student;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Student>
 */
class StudentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Student::class);
    }

    //    /**
    //     * @return Student[] Returns an array of Student objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('s.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Student
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    public function findAllByme()
       {
        return $this
        ->getEntityManager()
        ->createQuery('select s from App\Entity\Student s')
        ->getResult();


       }
    public function findallQB(){
       $qb= $this->createQueryBuilder('s');
       $qb->select('s.name')
       ->orderBy('s.name','DESC')
       ->join('s.classroom','c')
       ->addSelect('c.name n');
        return $qb->getQuery()->getResult();
    }
    public function searchByName($name){
        return 
        $this
        ->createQueryBuilder('s')
        ->where('s.name=?1')
        ->setParameter('1',$name)
        ->getQuery()
        ->getResult();

    }
}

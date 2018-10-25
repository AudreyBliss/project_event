<?php

namespace AppBundle\Repository;

/**
 * ProjectRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProjectRepository extends \Doctrine\ORM\EntityRepository
{
    public function findpastEvent(){
        $query = $this->createQueryBuilder('p')
        ->where('p.date < :date')
        ->setParameter('date', '22/10/2018')
        ->getQuery();

$projects = $query->getResult();
       
    }
}
 
<?php

namespace App\Repository;

use App\Data\SearchData;
use App\Entity\Challenge;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Challenge>
 *
 * @method Challenge|null find($id, $lockMode = null, $lockVersion = null)
 * @method Challenge|null findOneBy(array $criteria, array $orderBy = null)
 * @method Challenge[]    findAll()
 * @method Challenge[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChallengeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Challenge::class);
    }

    public function add(Challenge $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Challenge $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /* this methode  allow us to search challenges*/
    public function findSearch(SearchData $search): array
    {
        $query = $this
            ->createQueryBuilder('challenge')
            ->select('challenge', 'type')
            ->join('challenge.type', 'type')
            ->select('challenge', 'level')
            ->join('challenge.level', 'level')
            ->select('challenge', 'languages')
            ->join('challenge.languages', 'languages');

        if (!empty($search->sendSearch)) {
            $query = $query
                ->andWhere('challenge.name LIKE :sendSearch')
                ->setParameter('sendSearch', "%{$search->sendSearch}%");
        }

        if (!empty($search->types)) {
            $query = $query
                ->andWhere('type.id IN (:types)')
                ->setParameter('types', $search->types);
        }

        if (!empty($search->levels)) {
            $query = $query
                ->andWhere('level.id IN (:levels)')
                ->setParameter('levels', $search->levels);
        }

        if (!empty($search->languages)) {
            $query = $query
                ->andWhere('languages.id IN (:languages)')
                ->setParameter('languages', $search->languages);
        }

        return $query->getQuery()->getResult();
    }
    //
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Challenge
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}

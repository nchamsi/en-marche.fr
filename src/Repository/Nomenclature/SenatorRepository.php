<?php

namespace AppBundle\Repository\Nomenclature;

use AppBundle\Entity\Nomenclature\Senator;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class SenatorRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Senator::class);
    }

    public function findByStatusOrderedByAreaLabel(string $status = Senator::ENABLED): array
    {
        return $this->createQueryBuilder('senator')
            ->where('senator.status = :status')
            ->setParameter('status', $status)
            ->orderBy('senator.areaLabel')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findOneByEmail(string $email): ?Senator
    {
        return $this->createQueryBuilder('senator')
            ->where('senator.emailAddress = :email')
            ->setParameter('email', $email)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}

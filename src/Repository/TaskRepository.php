<?php

namespace App\Repository;

use App\Entity\Task;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Task>
 */
class TaskRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Task::class);
    }

    /**
     * @return Task[] Returns an array of Task objects
     */
    public function findByKeyWord(string $keyWord, User $currentUser, string $sortOrder): array
    {
        $keyWord = '%' . $keyWord . '%';
        if(!in_array($sortOrder, ['ASC', 'DESC'], true)){
            $sortOrder = 'DESC';
        }
        return $this->createQueryBuilder('t')
            ->andWhere('t.title LIKE :val')
            ->andWhere('t.user = :user')
            ->setParameter('val', $keyWord)
            ->setParameter('user', $currentUser)
            ->orderBy('t.createdAt', $sortOrder)
            ->getQuery()
            ->getResult()
            ;
    }
}

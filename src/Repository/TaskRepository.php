<?php

namespace App\Repository;

use App\Entity\Task;
use App\Entity\User;
use App\Utils\TaskSearchCriteria;
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
    public function findByCriteria(TaskSearchCriteria $taskSearchCriteria, User $currentUser): array
    {
        $taskSearchCriteria->setKeyWord('%' . $taskSearchCriteria->getKeyWord() . '%');
//        if(!in_array($sortOrder, ['ASC', 'DESC'], true)){
//            $sortOrder = 'DESC';
//        }
        return $this->createQueryBuilder('t')
            ->andWhere('t.title LIKE :val')
            ->andWhere('t.user = :user')
            ->setParameter('val', $taskSearchCriteria->getKeyWord())
            ->setParameter('user', $currentUser)
            ->orderBy('t.createdAt', $taskSearchCriteria->getSortOrder())
            ->getQuery()
            ->getResult()
            ;
    }
}

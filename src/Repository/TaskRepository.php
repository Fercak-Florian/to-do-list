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
        $keyWord = '%' . $taskSearchCriteria->getKeyWord() . '%';
        $sortMode = '';
        $targetField = '';

        switch ($taskSearchCriteria->getSortMode()) {
            case 'created_desc':
                $targetField = 't.createdAt';
                $sortMode = 'DESC';
                break;
            case 'created_asc':
                $targetField = 't.createdAt';
                $sortMode = 'ASC';
                break;
            case 'deadline_desc':
                $targetField = 't.deadline';
                $sortMode = 'DESC';
                break;
            case 'deadline_asc':
                $targetField = 't.deadline';
                $sortMode = 'ASC';
                break;
            default :
                $targetField = 't.createdAt';
                $sortMode = 'DESC';
        }


        return $this->createQueryBuilder('t')
            ->andWhere('t.title LIKE :val')
            ->andWhere('t.user = :user')
            ->setParameter('val', $keyWord)
            ->setParameter('user', $currentUser)
            ->orderBy($targetField, $sortMode)
            ->getQuery()
            ->getResult()
            ;
    }

    public function findUserCompletedTasks(User $currentUser): array {
        return $this->createQueryBuilder('t')
            ->andWhere('t.user = :user')
            ->andWhere('t.completed = true')
            ->setParameter('user', $currentUser)
            ->getQuery()
            ->getResult()
            ;
    }
}

<?php

namespace App\Repository;

use App\Entity\Task;
use App\Entity\User;
use App\Enum\TaskSortMode;
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
        $isCompleted = $taskSearchCriteria->isCompleted();
        $sortMode = '';
        $targetField = '';

        switch ($taskSearchCriteria->getSortMode()) {
            case TaskSortMode::CREATED_DESC:
                $targetField = 't.createdAt';
                $sortMode = 'DESC';
                break;
            case TaskSortMode::CREATED_ASC:
                $targetField = 't.createdAt';
                $sortMode = 'ASC';
                break;
            case TaskSortMode::DEADLINE_DESC:
                $targetField = 't.deadline';
                $sortMode = 'DESC';
                break;
            case TaskSortMode::DEADLINE_ASC:
                $targetField = 't.deadline';
                $sortMode = 'ASC';
                break;
        }


        return $this->createQueryBuilder('t')
            ->andWhere('t.title LIKE :val')
            ->andWhere('t.user = :user')
            ->andWhere('t.completed = :completed')
            ->setParameter('val', $keyWord)
            ->setParameter('user', $currentUser)
            ->setParameter('completed', $isCompleted)
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

    /**
     * @param User $user
     * @param int $taskId
     * @return Task|null
     */
    public function findOneByUserAndId(User $user, int $taskId): Task|null
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.user = :user')
            ->andWhere('t.id = :id')
            ->setParameter('user', $user)
            ->setParameter('id', $taskId)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }
}

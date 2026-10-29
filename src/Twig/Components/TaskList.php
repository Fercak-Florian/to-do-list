<?php

namespace App\Twig\Components;

use App\Entity\User;
use App\Repository\TaskRepository;
use App\Utils\TaskSearchCriteria;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveArg;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
final class TaskList extends AbstractController
{
    use DefaultActionTrait;

    #[LiveProp(writable: true)]
    public string $keyWord = '';

    #[LiveProp(writable: true)]
    public string $sortMode = 'created_desc';

    public function __construct(private TaskRepository $taskRepository,
                                private Security $security,
                                private EntityManagerInterface $entityManager)
    {
    }

    public function getTasksByCriteria(): array
    {
        $taskSearchCriteria = new TaskSearchCriteria($this->keyWord, $this->sortMode, false);
        $currentUser = $this->security->getUser();
        if(!$currentUser instanceof User) {
            return [];
        }
        return $this->taskRepository->findByCriteria($taskSearchCriteria, $currentUser);
    }

    public function getCompletedTasks(): array
    {
        $currentUser = $this->security->getUser();
        if(!$currentUser instanceof User) {
            return [];
        }
        return $this->taskRepository->findUserCompletedTasks($currentUser);
    }

    #[LiveAction]
    public function toggleCompletedStatus(#[LiveArg] int $id): void
    {
        $task = $this->taskRepository->find($id);
        if ($task === null) {
            $this->addFlash('error', 'Tâche introuvable.');
            return;
        }

        $currentUser = $this->security->getUser();
        if (!$currentUser instanceof User) {
            $this->addFlash('error', 'Vous devez être connecté.');
            return;
        }

        if ($task->getUser()->getId() !== $currentUser->getId()) {
            $this->addFlash('error', 'Vous n\'êtes pas autorisé à modifier cette tâche.');
            return;
        }

        $task->toggleStatus();
        $this->entityManager->flush();

        $this->addFlash('success', $task->isCompleted() ? 'Tâche complétée !' : 'Tâche rouverte.');
    }
}

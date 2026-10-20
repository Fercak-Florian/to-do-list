<?php

namespace App\Twig\Components;

use App\Entity\User;
use App\Repository\TaskRepository;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
final class TaskList
{
    use DefaultActionTrait;

    #[LiveProp(writable: true)]
    public string $query = '';

    #[LiveProp(writable: true)]
    public string $sortOrder = 'DESC';

    public function __construct(private TaskRepository $taskRepository, private Security $security)
    {
    }

    public function getTasksByKeyWord(): array
    {
        $currentUser = $this->security->getUser();
        if(!$currentUser instanceof User) {
            return [];
        }
        return $this->taskRepository->findByKeyWord($this->query, $currentUser, $this->sortOrder);
    }
}

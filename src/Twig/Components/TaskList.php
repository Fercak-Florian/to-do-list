<?php

namespace App\Twig\Components;

use App\Entity\User;
use App\Repository\TaskRepository;
use App\Utils\TaskSearchCriteria;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
final class TaskList
{
    use DefaultActionTrait;

    #[LiveProp(writable: true)]
    public string $keyWord = '';

    #[LiveProp(writable: true)]
    public string $sortMode = 'created_desc';

    public function __construct(private TaskRepository $taskRepository, private Security $security)
    {
    }

    public function getTasksByCriteria(): array
    {
        $taskSearchCriteria = new TaskSearchCriteria($this->keyWord, $this->sortMode);
        $currentUser = $this->security->getUser();
        if(!$currentUser instanceof User) {
            return [];
        }
        return $this->taskRepository->findByCriteria($taskSearchCriteria, $currentUser);
    }
}

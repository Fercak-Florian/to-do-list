<?php

namespace App\Utils;

class TaskSearchRequest
{
    private ?string $request = '';

    public function getRequest(): ?string
    {
        return $this->request;
    }

    public function setRequest(?string $request): void
    {
        $this->request = $request;
    }
}

<?php

namespace App\Utils;

class TaskSearchCriteria
{
    private ?string $keyWord = '';
    private ?string $sortOrder = 'DESC';

    /**
     * @param string|null $keyWord
     * @param string|null $sortOrder
     */
    public function __construct(?string $keyWord, ?string $sortOrder)
    {
        $this->keyWord = $keyWord;
        $this->sortOrder = $sortOrder;
    }

    public function getSortOrder(): ?string
    {
        return $this->sortOrder;
    }

    public function setSortOrder(?string $sortOrder): void
    {
        $this->sortOrder = $sortOrder;
    }

    public function getKeyWord(): ?string
    {
        return $this->keyWord;
    }

    public function setKeyWord(?string $keyWord): void
    {
        $this->keyWord = $keyWord;
    }
}

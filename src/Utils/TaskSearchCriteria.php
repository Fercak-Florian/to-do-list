<?php

namespace App\Utils;

class TaskSearchCriteria
{
    private string $keyWord = '';
    private string $sortMode = 'created_desc';
    private bool $isCompleted = false;

    /**
     * @param string $keyWord
     * @param string $sortMode
     */
    public function __construct(string $keyWord, string $sortMode, bool $isCompleted)
    {
        $this->keyWord = $keyWord;
        $this->sortMode = $sortMode;
        $this->isCompleted = $isCompleted;
    }

    public function isCompleted(): bool
    {
        return $this->isCompleted;
    }

    public function setIsCompleted(bool $isCompleted): void
    {
        $this->isCompleted = $isCompleted;
    }

    public function getSortMode(): string
    {
        return $this->sortMode;
    }

    public function setSortMode(string $sortMode): void
    {
        $this->sortMode = $sortMode;
    }

    public function getKeyWord(): string
    {
        return $this->keyWord;
    }

    public function setKeyWord(string $keyWord): void
    {
        $this->keyWord = $keyWord;
    }
}

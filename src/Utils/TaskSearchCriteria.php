<?php

namespace App\Utils;

class TaskSearchCriteria
{
    private string $keyWord = '';
    private string $sortMode = 'created_desc';

    /**
     * @param string $keyWord
     * @param string $sortMode
     */
    public function __construct(string $keyWord, string $sortMode)
    {
        $this->keyWord = $keyWord;
        $this->sortMode = $sortMode;
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

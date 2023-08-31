<?php

namespace App\Services;

use App\Entity\Issue;
use App\Collections\IssueCollection;
use App\Interfaces\IssueServiceInterface;

class IssueHandlerService implements IssueServiceInterface
{
    public function getAll(): IssueCollection
    {
        return new IssueCollection();
    }

    public function add(Issue $issue): void
    {
    }

    public function calculateDueDate(Issue $issue): Issue
    {
        return new Issue('test', 'test', 0);
    }
}

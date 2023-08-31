<?php

namespace App\Interfaces;

use App\Collections\IssueCollection;
use App\Entity\Issue;

interface IssueServiceInterface
{
    public function getAll(): IssueCollection;
    public function add(Issue $issue): void;
    public function calculateDueDate(Issue $issue): Issue;
}

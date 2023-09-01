<?php

namespace App\Interfaces;

use App\Collections\IssueCollection;
use App\Entity\Issue;

interface IssueHandlerServiceInterface
{
    public function getAll(): IssueCollection;
    public function create(string $issueJson): Issue;
    public function add(Issue $issue): void;
    public function calculateDueDate(Issue $issue): Issue;
}

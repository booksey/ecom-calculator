<?php

namespace App\Interfaces;

use App\Entity\Issue;

interface IssueFactoryInterface
{
    public function create(string $issueJson): Issue;
}

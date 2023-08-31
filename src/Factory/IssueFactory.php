<?php

namespace App\Factory;

use App\Entity\Issue;
use DateTime;

class IssueFactory
{
    public function create(string $userJson): Issue
    {
        return new Issue('test', 'test', 0, new DateTime('now'));
    }
}

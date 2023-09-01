<?php

declare(strict_types=1);

namespace App\Collections;

use App\Entity\Issue;
use ArrayIterator;
use Countable;
use IteratorAggregate;
use Traversable;

final class IssueCollection implements IteratorAggregate, Countable
{
    public array $issues;

    public function __construct(Issue ...$issue)
    {
        $this->issues = $issue;
    }

    public function add(Issue $issue): void
    {
        $this->issues[] = $issue;
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->issues);
    }

    public function count(): int
    {
        return count($this->issues);
    }
}

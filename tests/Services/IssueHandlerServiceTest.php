<?php

declare(strict_types=1);

namespace App\Test\Services;

use App\Entity\Issue;
use App\Interfaces\IssueHandlerServiceInterface;
use App\Services\IssueHandlerService;
use PHPUnit\Framework\TestCase;

class CreateActionTest extends TestCase
{
    private readonly IssueHandlerServiceInterface $issueHandler;

    protected function setUp(): void
    {
        $this->issueHandler = new IssueHandlerService();
    }

    public function testGetAll(): void
    {
    }

    public function testAdd(Issue $issue): void
    {
    }

    /**
     * @dataProvider calculateDataProvider
     */
    public function testCalculateDueDate(Issue $issue): void
    {
    }

    public static function calculateDataProvider(): array
    {
        return [];
    }
}

<?php

declare(strict_types=1);

namespace App\Test\Services;

use App\Collections\IssueCollection;
use App\Entity\Issue;
use App\Interfaces\IssueFactoryInterface;
use App\Interfaces\IssueHandlerServiceInterface;
use App\Services\IssueHandlerService;
use PHPUnit\Framework\TestCase;

class IssueHandlerServiceTest extends TestCase
{
    private readonly IssueHandlerServiceInterface $issueHandler;

    protected function setUp(): void
    {
        $issueFactory = $this->createMock(IssueFactoryInterface::class);
        $this->issueHandler = new IssueHandlerService($issueFactory);
    }

    public function testGetAll(): void
    {
        $list = $this->issueHandler->getAll();
        $this->assertInstanceOf(IssueCollection::class, $list);
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

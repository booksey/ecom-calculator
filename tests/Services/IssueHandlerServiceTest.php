<?php

declare(strict_types=1);

namespace App\Test\Services;

use App\Collections\IssueCollection;
use App\Entity\Issue;
use App\Factory\IssueFactory;
use App\Interfaces\IssueHandlerServiceInterface;
use App\Services\IssueHandlerService;
use DateTime;
use PHPUnit\Framework\TestCase;

class IssueHandlerServiceTest extends TestCase
{
    private readonly IssueHandlerServiceInterface $issueHandler;

    protected function setUp(): void
    {
        $issueFactory = new IssueFactory();
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
    public function testCalculateDueDate(string $issueJson, string $expectedDate): void
    {
        $issue = $this->issueHandler->create($issueJson);
        $this->issueHandler->calculateDueDate($issue);
        /** @var DateTime $dueDate */
        $dueDate = $issue->getDueDate();
        $this->assertEquals($expectedDate, $dueDate->format('Y-m-d H:i:s'));
    }

    public static function calculateDataProvider(): array
    {
        //monday + 1 day, expecting thursday
        $testIssue1 = ['issuer' => 't', 'text' => 't', 'estimatedHours' => 6, 'created' => '2023-09-04 16:00:00'];
        $expected1 = '2023-09-05 16:00:00';

        //monday + 2 days, expecting wednesday
        $testIssue2 = ['issuer' => 't', 'text' => 't', 'estimatedHours' => 10, 'created' => '2023-09-04 16:00:00'];
        $expected2 = '2023-09-06 16:00:00';

        //friday + 1 day, expecting monday
        $testIssue3 = ['issuer' => 't', 'text' => 't', 'estimatedHours' => 6, 'created' => '2023-09-01 16:00:00'];
        $expected3 = '2023-09-04 16:00:00';

        //friday + 2 day, expecting thursday
        $testIssue4 = ['issuer' => 't', 'text' => 't', 'estimatedHours' => 12, 'created' => '2023-09-01 16:00:00'];
        $expected4 = '2023-09-05 16:00:00';

        return [
            [json_encode($testIssue1), $expected1],
            [json_encode($testIssue2), $expected2],
            [json_encode($testIssue3), $expected3],
            [json_encode($testIssue4), $expected4],
        ];
    }
}

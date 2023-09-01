<?php

namespace App\Services;

use App\Entity\Issue;
use App\Collections\IssueCollection;
use App\Interfaces\IssueFactoryInterface;
use App\Interfaces\IssueHandlerServiceInterface;
use DateInterval;
use DateTime;

class IssueHandlerService implements IssueHandlerServiceInterface
{
    private const ISSUE_JSON_FILE = __DIR__ . '/../../issues.json';

    public function __construct(
        private readonly IssueFactoryInterface $issueFactory
    ) {
        if (!file_exists(self::ISSUE_JSON_FILE)) {
            file_put_contents(self::ISSUE_JSON_FILE, '');
        }
    }

    public function getAll(): IssueCollection
    {
        $issueCollection = new IssueCollection();
        $jsonFileContent = file_get_contents(self::ISSUE_JSON_FILE);

        if ($jsonFileContent) {
            $issueJsons = explode("\n", trim($jsonFileContent));
            foreach ($issueJsons as $issueJson) {
                $issue = $this->create($issueJson);
                $issueCollection->add($issue);
            }
        }

        return $issueCollection;
    }

    public function create(string $issueJson): Issue
    {
        return $this->issueFactory->create($issueJson);
    }

    public function add(Issue $issue): void
    {
        $this->calculateDueDate($issue);
        file_put_contents(self::ISSUE_JSON_FILE, json_encode($issue) . "\n", FILE_APPEND);
    }

    public function calculateDueDate(Issue $issue): Issue
    {
        $createdAt = $issue->getCreated();
        $estimatedHours = $issue->getEstimatedHours();
        $daysToResolve = ceil($estimatedHours / 8);
        $dueDate = $createdAt->modify("+" . $daysToResolve . " weekdays");

        return $issue->setDueDate($dueDate);
    }
}

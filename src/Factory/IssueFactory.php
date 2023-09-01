<?php

namespace App\Factory;

use App\Entity\Issue;
use App\Interfaces\IssueFactoryInterface;
use DateTime;
use RuntimeException;
use Webmozart\Assert\Assert;

class IssueFactory implements IssueFactoryInterface
{
    public function create(string $issueJson): Issue
    {
        $issueArray = json_decode($issueJson, true);
        if (!is_array($issueArray)) {
            throw new RuntimeException('Invalid issueJson');
        }
        $issuer = $issueArray['issuer'] ?? '';
        $text = $issueArray['text'] ?? '';
        $estimatedHours = $issueArray['estimatedHours'] ?? 0;

        /** @var DateTime $created */
        $created = !empty($issueArray['created'])
            ? DateTime::createFromFormat('Y-m-d H:i:s', $issueArray['created'])
            : new DateTime('now');

        /** @var DateTime|null $dueDate */
        $dueDate = !empty($issueArray['dueDate'])
            ? DateTime::createFromFormat('Y-m-d H:i:s', $issueArray['dueDate'])
            : null;

        Assert::stringNotEmpty($issuer, 'Bejelentő neve kötelező!');
        Assert::stringNotEmpty($text, 'Bejelentés szövege kötelező!');
        Assert::integerish($estimatedHours, 'Átfutási idő kötelező!');
        Assert::greaterThan($estimatedHours, 0, 'Érvénytelen átfutási idő' . $estimatedHours);

        return new Issue($issuer, $text, intval($estimatedHours), $created, $dueDate);
    }
}

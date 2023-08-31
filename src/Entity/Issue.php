<?php

namespace App\Entity;

use DateTime;

class Issue
{
    private DateTime $dueDate;
    private readonly DateTime $created;

    public function __construct(
        private string $issuer,
        private string $text,
        private int $estimatedHours,
    ) {
        $this->created = new DateTime('now');
    }

    public function getIssuer(): string
    {
        return $this->issuer;
    }

    public function setIssuer(string $issuer): Issue
    {
        $this->issuer = $issuer;

        return $this;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): Issue
    {
        $this->text = $text;

        return $this;
    }

    public function getEstimatedHours(): int
    {
        return $this->estimatedHours;
    }

    public function setEstimatedHours(int $hours): Issue
    {
        $this->estimatedHours = $hours;

        return $this;
    }

    public function getDueDate(): DateTime
    {
        return $this->dueDate;
    }

    public function setDueDate(DateTime $dueDate): Issue
    {
        $this->dueDate = $dueDate;

        return $this;
    }

    public function getCreated(): DateTime
    {
        return $this->created;
    }
}

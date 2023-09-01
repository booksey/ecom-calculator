<?php

namespace App\Console;

use App\Entity\Issue;
use App\Interfaces\IssueHandlerServiceInterface;
use DateTime;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class ListIssuesCommand extends Command
{
    public function __construct(
        private IssueHandlerServiceInterface $issueHandler,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        parent::configure();

        $this->setName('list-issues');
        $this->setDescription('Command to list issues from issues.json');
    }

    /** @SuppressWarnings(PHPMD.UnusedFormalParameter) */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $issues = $this->issueHandler->getAll();

        $output->writeln(sprintf('<info>Bejelentések:</info>'));
        $output->writeln('');

        if ($issues->count() < 1) {
            $output->writeln('<error>Nem találhatóak bejelentések</error>');
            return 0;
        }

        /** @var Issue $issue */
        foreach ($issues as $issue) {
            $output->writeln(sprintf('<comment>Bejelentő: </comment>' . $issue->getIssuer()));
            $output->writeln(sprintf('<comment>Bejelentés szóvege: </comment>' . $issue->getText()));
            $output->writeln(
                sprintf('<comment>Bejelentés időpontja: </comment>' . $issue->getCreated()->format('Y-m-d H:i:s'))
            );
            $output->writeln(sprintf('<comment>Átfutási idő: </comment>' . $issue->getEstimatedHours()) . ' óra');
            $output->writeln(
                sprintf('<comment>Esedékesség időpontja: </comment>' . $issue->getDueDate()?->format('Y-m-d H:i:s'))
            );
            $output->writeln('');
        }

        return 0;
    }
}

<?php

namespace App\Console;

use App\Interfaces\IssueHandlerServiceInterface;
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

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln(sprintf('<info>List issue command</info>'));
        return 0;
    }
}

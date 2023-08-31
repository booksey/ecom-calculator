<?php

namespace App\Console;

use App\Interfaces\IssueHandlerServiceInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class AddIssueCommand extends Command
{
    public function __construct(
        private IssueHandlerServiceInterface $issueHandler,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        parent::configure();

        $this->setName('add-issue');
        $this->setDescription('Command to add an issue to issues.json');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln(sprintf('<info>Add issue command</info>'));
        return 0;
    }
}

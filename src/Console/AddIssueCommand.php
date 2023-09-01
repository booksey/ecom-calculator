<?php

namespace App\Console;

use App\Interfaces\IssueHandlerServiceInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

final class AddIssueCommand extends Command
{
    public function __construct(
        private IssueHandlerServiceInterface $issueHandler
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
        /** @var QuestionHelper $questionHelper */
        $questionHelper = $this->getHelper('question');
        $issuerQuestion = new Question('Bejelentő neve: ', '');
        $textQuestion = new Question('Bejelentés szövege: ', '');
        $eHoursQuestion = new Question('Átfutási idő: ', 0);

        $issuer = $questionHelper->ask($input, $output, $issuerQuestion);
        $text = $questionHelper->ask($input, $output, $textQuestion);
        /** @var string $estiamtedHours */
        $estiamtedHours = $questionHelper->ask($input, $output, $eHoursQuestion);

        $issue = [
            'issuer' => $issuer,
            'text' => $text,
            'estimatedHours' => intval($estiamtedHours),
        ];

        /** @var string $issueJson */
        $issueJson = json_encode($issue);
        $issue = $this->issueHandler->create($issueJson);
        $this->issueHandler->add($issue);

        $output->writeln(sprintf('<info>Bejelentés létrehozva</info>'));

        return 0;
    }
}

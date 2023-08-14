<?php

declare(strict_types=1);

namespace Application\CLI;

use Application\CommandBus;
use Domain\Command\Newsfeed\Retrieve;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(name: 'app:retrieve-news-feed', description: 'Retrieves news-feed')]
final class RetrieveNewsfeedCommand extends Command
{
    public function __construct(private readonly CommandBus $commandBus)
    {
        parent::__construct();
    }

    /**
     * {@inheritDoc}
     */
    protected function configure(): void
    {
        $this->addOption(
            name: 'last-record-id',
            shortcut: 'i',
            mode: InputOption::VALUE_OPTIONAL,
            description: 'Last record ID'
        );
    }

    /**
     * {@inheritDoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $lastRecordId = $input->getOption('last-record-id');
        $this->commandBus->execute(new Retrieve($lastRecordId));

        $io->writeln('Newsfeeds retrieves');

        return Command::SUCCESS;
    }
}

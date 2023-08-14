<?php

declare(strict_types=1);

namespace Domain\CommandHandler\Newsfeed;

use Domain\Command\Newsfeed as Command;
use Domain\Repository\Newsfeeds;

final class RetrieveHandler
{
    public function __construct(private readonly Newsfeeds $newsfeeds)
    {
    }

    public function __invoke(Command\Retrieve $command): void
    {
    }
}

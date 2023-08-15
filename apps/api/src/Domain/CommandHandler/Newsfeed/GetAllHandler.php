<?php

declare(strict_types=1);

namespace Domain\CommandHandler\Newsfeed;

use Domain\Command\Newsfeed as Command;
use Domain\Model\Newsfeed;
use Domain\Repository\Newsfeeds;

final class GetAllHandler
{
    public function __construct(private readonly Newsfeeds $newsfeeds)
    {
    }

    /**
     * @return iterable<Newsfeed>
     */
    public function __invoke(Command\GetAll $command): iterable
    {
        return $this->newsfeeds->findAll();
    }
}

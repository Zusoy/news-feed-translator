<?php

declare(strict_types=1);

namespace Domain\CommandHandler\Newsfeed;

use Domain\Command\Newsfeed as Command;
use Domain\NewsfeedProvider;
use Domain\Repository\Newsfeeds;

final class RetrieveHandler
{
    public function __construct(
        private readonly NewsfeedProvider $provider,
        private readonly Newsfeeds $newsfeeds
    ) {
    }

    public function __invoke(Command\Retrieve $command): void
    {
        /** @var null|int */
        $lastRecordId = $command->lastRecordId ?? $this->newsfeeds->findLastRecordId();
        $records = $this->provider->getLatestNewsfeeds(maxRecordId: $lastRecordId, translate: (bool) $lastRecordId);

        foreach ($records as $newsfeed) {
            if ($this->newsfeeds->findByProviderId($newsfeed->providerId)) {
                continue;
            }

            $this->newsfeeds->add($newsfeed);
        }

        $this->newsfeeds->flush();
    }
}

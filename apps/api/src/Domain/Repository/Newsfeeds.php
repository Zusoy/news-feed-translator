<?php

declare(strict_types=1);

namespace Domain\Repository;

use Domain\Model\Newsfeed;

interface Newsfeeds
{
    public function add(Newsfeed $newsfeed): void;

    public function findLastRecordId(): ?int;

    public function findByProviderId(int $providerId): ?Newsfeed;

    /**
     * @return iterable<Newsfeed>
     */
    public function findAll(): iterable;

    public function flush(): void;
}

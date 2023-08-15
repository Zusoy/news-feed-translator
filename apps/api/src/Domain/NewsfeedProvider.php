<?php

declare(strict_types=1);

namespace Domain;

use Domain\Model\Newsfeed;

interface NewsfeedProvider
{
    /**
     * @return iterable<Newsfeed>
     */
    public function getLatestNewsfeeds(?int $maxRecordId = null, ?bool $translate = true): iterable;
}

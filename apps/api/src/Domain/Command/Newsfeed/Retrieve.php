<?php

declare(strict_types=1);

namespace Domain\Command\Newsfeed;

final class Retrieve
{
    public function __construct(public readonly ?string $lastRecordId = null)
    {
    }
}

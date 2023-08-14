<?php

declare(strict_types=1);

namespace Domain\Model;

use DateTimeImmutable;
use Domain\Identity\Identifiable;
use Domain\Identity\Identifier;

class Newsfeed implements Identifiable
{
    private readonly Identifier $id;
    public readonly int $providerId;
    public readonly int $providerRecordId;
    public readonly DateTimeImmutable $writtenAt;
    public readonly Translation $title;
    public readonly ?Translation $subtitle;
    public readonly ?Translation $body;
    public readonly bool $alert;

    public function __construct(
        int $providerId,
        int $providerRecordId,
        DateTimeImmutable $writtenAt,
        Translation $title,
        ?Translation $subtitle,
        ?Translation $body,
        bool $alert
    ) {
        $this->id = Identifier::generate();
        $this->providerId = $providerId;
        $this->providerRecordId = $providerRecordId;
        $this->writtenAt = $writtenAt;
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->body = $body;
        $this->alert = $alert;
    }

    public function getIdentifier(): Identifier
    {
        return $this->id;
    }
}

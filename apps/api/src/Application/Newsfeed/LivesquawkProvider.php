<?php

declare(strict_types=1);

namespace Application\Newsfeed;

use Application\Newsfeed\Client\LivesquawkClient;
use DateTimeImmutable;
use Domain\Model\Newsfeed;
use Domain\NewsfeedProvider as ProviderInterface;
use Domain\Translator;
use Throwable;

final class LivesquawkProvider implements ProviderInterface
{
    public function __construct(private readonly Translator $translator, private readonly LivesquawkClient $client)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function getLatestNewsfeeds(?int $maxRecordId = null, ?bool $translate = true): iterable
    {
        $records = $this->client->getAllFrom($maxRecordId)['data'];
        $newsfeeds = [];

        foreach($records as $record) {
            try{
                $newsfeed = new Newsfeed(
                    providerId: (int) $record['ID'],
                    providerRecordId: (int) $record['record_id'],
                    writtenAt: (new DateTimeImmutable())->setTimeStamp((int) $record['date_write']),
                    title: $this->translator->translate($record['title']),
                    subtitle: $record['subtitle'] && $translate ? $this->translator->translate($record['subtitle']) : null,
                    body: $record['body'] && $translate ? $this->translator->translate($record['body']) : null,
                    alert: (bool) $record['alert']
                );

                $newsfeeds[] = $newsfeed;
            } catch(Throwable $e) {
                dump($e);
                continue;
            }
        }

        return $newsfeeds;
    }
}

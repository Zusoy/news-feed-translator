<?php

declare(strict_types=1);

namespace Application\Normalization\Normalizer;

use Application\Normalization\Normalizer;
use Domain\Model\Newsfeed;

/**
 * @implements Normalizer<Newsfeed>
 */
final class NewsfeedNormalizer implements Normalizer
{
    /**
     * {@inheritDoc}
     */
    public function supports(mixed $data): bool
    {
        return $data instanceof Newsfeed;
    }

    /**
     * {@inheritDoc}
     *
     * @param Newsfeed $data
     *
     * @return array<string,string>
     */
    public function normalize(mixed $data): mixed
    {
        return [
            'ID' => (string) $data->providerId,
            'record_id' => (string) $data->providerRecordId,
            'date_write' => (string) $data->writtenAt->getTimestamp(),
            'title' => (string) $data->title,
            'subtitle' => $data->subtitle ? (string) $data->subtitle : '',
            'body' => $data->body ? (string) $data->body : '',
            'alert' => $data->alert ? '1' : '0'
        ];
    }
}

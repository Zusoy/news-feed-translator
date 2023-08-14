<?php

declare(strict_types=1);

namespace Application\Newsfeed\Client;

use InvalidArgumentException;
use Symfony\Contracts\HttpClient\HttpClientInterface;

/**
 * @phpstan-type Record array{
 *   ID: int,
 *   record_id: int,
 *   date_write: int,
 *   title: string,
 *   subtitle: string,
 *   body: string,
 *   alert: int
 *  }
 */
final class LivesquawkClient
{
    public function __construct(
        private readonly HttpClientInterface $httpClient,
        private readonly string $livesquawkUrl,
        private readonly string $livesquawkApiKey
    ) {
    }

    /**
     * @return array {
     *  max_record_id: int,
     *  data: array<Record>
     * }
     */
    public function getAllFrom(?int $id = null): array
    {
        $response = $this->httpClient->request(
            method: 'GET',
            url: sprintf(
                '%s&from=%d',
                $this->getProviderUrl(),
                $id
            )
        );

        $arrayResponse = $response->toArray();

        if (!array_key_exists('max_record_id', $arrayResponse)) {
            throw new InvalidArgumentException('Cannot get max_record_id from response');
        }

        if (!array_key_exists('data', $arrayResponse)) {
            throw new InvalidArgumentException('Cannot get data from response');
        }

        if (!is_array($arrayResponse['data'])) {
            throw new InvalidArgumentException('Cannot get data from response');
        }

        foreach ($arrayResponse['data'] as $record) {
            if (!array_key_exists('ID', $record)) {
                throw new InvalidArgumentException('Cannot get ID from record');
            }

            if (!array_key_exists('record_id', $record)) {
                throw new InvalidArgumentException('Cannot get record_id from record');
            }

            if (!array_key_exists('date_write', $record)) {
                throw new InvalidArgumentException('Cannot get date_write from record');
            }

            if (!array_key_exists('title', $record)) {
                throw new InvalidArgumentException('Cannot get title from record');
            }

            if (!array_key_exists('subtitle', $record)) {
                throw new InvalidArgumentException('Cannot get subtitle from record');
            }

            if (!array_key_exists('body', $record)) {
                throw new InvalidArgumentException('Cannot get body from record');
            }

            if (!array_key_exists('alert', $record)) {
                throw new InvalidArgumentException('Cannot get alert from record');
            }
        }

        return $arrayResponse;
    }

    private function getProviderUrl(): string
    {
        return sprintf(
            '%s?auth_key=%s',
            $this->livesquawkUrl,
            $this->livesquawkApiKey
        );
    }
}

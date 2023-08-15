<?php

declare(strict_types=1);

namespace Application\Translator;

use Domain\Model\Translation;
use InvalidArgumentException;
use Symfony\Contracts\HttpClient\ResponseInterface;

final class TranslationFactory
{
    public static function fromDeeplResponse(string $translatedLocale, string $originalText, ResponseInterface $httpResponse): Translation
    {
        if (200 !== $httpResponse->getStatusCode()) {
            throw new InvalidArgumentException('Cannot build object Translation because response is not valid');
        }

        $arrayDeeplResponse = $httpResponse->toArray();

        if (
            array_key_exists('translations', $arrayDeeplResponse)
            && array_key_exists(0, $arrayDeeplResponse['translations'])
            && array_key_exists('text', $arrayDeeplResponse['translations'][0])
        ) {
            return new Translation(
                $originalText,
                $arrayDeeplResponse['translations'][0]['detected_source_language'],
                $arrayDeeplResponse['translations'][0]['text'],
                $translatedLocale
            );
        }

        throw new InvalidArgumentException('Cannot build object Translation because response is not valid');
    }
}

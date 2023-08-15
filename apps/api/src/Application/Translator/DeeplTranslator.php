<?php

declare(strict_types=1);

namespace Application\Translator;

use Domain\Model\Translation;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class DeeplTranslator implements \Domain\Translator
{
    public function __construct(
        private readonly string $apiKey,
        private readonly string $targetLanguage,
        private readonly string $domainUrl,
        private readonly HttpClientInterface $httpClient
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function translate(string $text): Translation
    {
        $response = $this->httpClient->request(
            method: 'POST',
            url: sprintf('https://%s/v2/translate', $this->domainUrl),
            options: [
                'headers' => [
                    'CAccept' => '*/*',
                    'Content-Type' => 'application/x-www-form-urlencoded',
                ],
                'body' => [
                    'auth_key' => $this->apiKey,
                    'target_lang' => $this->targetLanguage,
                    'text' => $text,
                ],
            ]
        );

        return TranslationFactory::fromDeeplResponse(
            translatedLocale: $this->targetLanguage,
            originalText: $text,
            httpResponse: $response
        );
    }
}

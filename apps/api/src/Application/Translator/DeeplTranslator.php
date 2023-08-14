<?php

declare(strict_types=1);

namespace Application\Translator;

use Domain\Model\Translation;

final class DeeplTranslator implements \Domain\Translator
{
    public function __construct(
        private readonly string $apiKey,
        private readonly string $targetLanguage,
        private readonly string $domainUrl,
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function translate(string $text): Translation
    {
        return TranslationFactory::fromDeeplResponse('', '');
    }
}
